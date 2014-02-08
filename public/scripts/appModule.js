define(['appRoutes', 'services/dependencyResolverFor', 'services/authenticationService'], function(config, dependencyResolverFor, authenticationService)
{
  'use strict';

  var app = angular.module('app', ['ngRoute', 'ngSanitize', 'ngCookies']);

  app.config(
    [
      '$routeProvider',
      '$locationProvider',
      '$controllerProvider',
      '$compileProvider',
      '$filterProvider',
      '$provide',

      function($routeProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide) {

        app.lazy =
        {
          controller : $controllerProvider.register,
          directive  : $compileProvider.directive,
          filter     : $filterProvider.register,
          factory    : $provide.factory,
          service    : $provide.service,
          constant   : $provide.constant
        };

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

        $locationProvider.html5Mode(true);

//        authenticationService.validate();
      }
    ]
  );

  app.run(function($rootScope, $location) {
    var routesThatRequireAuth = ['/pennants'];

    $rootScope.$on('$routeChangeStart', function(event, next, current) {
      if(_(routesThatRequireAuth).contains($location.path()) && !authenticationService.isLoggedIn()) {
        $location.path('/login');
        FlashService.show("Please log in to continue.");
      }
    });
  });

  return app;


});