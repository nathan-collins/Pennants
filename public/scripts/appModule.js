define(['appRoutes', 'services/dependencyResolverFor', 'global'], function(config, dependencyResolverFor, global)
{
  'use strict';

  var app = angular.module('app', ['ngRoute', 'ngSanitize']);

  app.config(
    [
      '$routeProvider',
      '$locationProvider',
      '$httpProvider',
      '$compileProvider',
      '$filterProvider',
      '$controllerProvider',
      '$provide',

      function($routeProvider, $locationProvider, $httpProvider, $compileProvider, $filterProvider, $controllerProvider, $provide) {

        app.lazy =
        {
          controller : $controllerProvider.register,
          directive  : $compileProvider.directive,
          filter     : $filterProvider.register,
          factory    : $provide.factory,
          service    : $provide.service,
          http       : $httpProvider.register,
          location   : $locationProvider.register

        };

        $locationProvider.html5Mode(true);

        if(config.routes !== undefined)
        {
          // grab each route
          angular.forEach(config.routes, function(route, path)
          {
            $routeProvider.when(path, {templateUrl: route.templateUrl, resolve:dependencyResolverFor(route.dependencies)})
          })
        }

        if(config.defaultRoutePaths !== undefined)
        {
          // return to the default route
          $routeProvider.otherwise({redirectedTo:config.defaultRoutePaths});
        }

        var logsOutUserOn401 = function($location, $q, SessionService, FlashService) {
          var success = function(response) {
            return response;
          };

          var error = function(response) {
            if(response.status === 401) {
              SessionService.unset('authenticated');
              $location.path('admin/login');
              FlashService.show(response.data.flash);
            }
            return $q.reject(response);
          };

          return function(promise) {
            return promise.then(success, error);
          };
        };

        $httpProvider.responseInterceptors.push(logsOutUserOn401);

      }
    ]);

  app.run(function($rootScope, $location, AuthenticationService, FlashService) {
    var routesThatRequireAuth = ["/pennants"];

    $rootScope.$on('$routeChangeStart', function(event, next, current) {
      if(_(routesThatRequireAuth).contains($location.path()) && !AuthenticationService.isLoggedIn()) {
        $location.path('admin/login');
        FlashService.show("Please log in to continue.");
      }
    });
  });

  app.factory("SessionService", function() {
    return {
      show: function(message) {
        $rootScope.flash = message;
      },
      clear: function() {
        $rootScope.flash = "";
      }
    }
  });

  app.factory("AuthenticationService", function($http, $sanitize, SessionService, FlashService) {

    var cacheSession   = function() {
      SessionService.set('authenticated', true);
    };

    var uncacheSession = function() {
      SessionService.unset('authenticated');
    };

    var loginError = function(response) {
      FlashService.show(response.flash);
    };

    var sanitizeCredentials = function(credentials) {
      return {
        username: $sanitize(credentials.username),
        password: $sanitize(credentials.password),
        csrf_token: global.CSRF_TOKEN
      };
    };

    return {
      login: function(credentials) {
        var login = $http.post("/auth/login", sanitizeCredentials(credentials));
        login.success(cacheSession);
        login.success(FlashService.clear);
        login.error(loginError);
        return login;
      },
      logout: function() {
        var logout = $http.get("/auth/logout");
        logout.success(uncacheSession);
        return logout;
      },
      isLoggedIn: function() {
        return SessionService.get('authenticated');
      }
    };
  });

  app.factory("SessionService", function() {
    return {
      get: function(key) {
        return sessionStorage.getItem(key);
      },
      set: function(key, val) {
        return sessionStorage.setItem(key, val);
      },
      unset: function(key) {
        return sessionStorage.removeItem(key);
      }
    }
  });

  app.factory("FlashService", function($rootScope) {
    return {
      show: function(message) {
        $rootScope.flash = message;
      },
      clear: function() {
        $rootScope.flash = "";
      }
    }
  });

  return app;
});