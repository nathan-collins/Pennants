var pennantsApp = angular.module('pennantsApp', ['ngSanitize'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.service('sessionService', function() {
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

pennantsApp.service('flashService', ['$rootScope', function($rootScope) {
  return {
    show: function(message) {
      $rootScope.flash = message;
    },
    clear: function() {
      $rootScope.flash = "";
    }
  }
}]);

pennantsApp.service('authenticationService', ['$rootScope', '$http', 'flashService', 'sessionService', function ($rootScope, $http, FlashService, SessionService, $sanitize) {
  var cacheSession   = function() {
    SessionService.set('authenticated', true);
  };

  var uncacheSession = function() {
    SessionService.unset('authenticated');
  };

  var loginError = function(response) {
    FlashService.show(response.flash);
  };

  var sanitizeCredentials = function(credentials)
  {
    return {
      username:  	$sanitize(credentials.username),
      password: 	$sanitize(credentials.password),
      csrf_token: pennants.CSRF_TOKEN
    };
  };

  var logsOutUserOn401 = function($location, $q) {
    var success = function(response) {
      return response;
    };

    var error = function(response) {
      if(response.status === 401) {
        SessionService.unset('authenticated');
        $location.path('/login');
        FlashService.show(response.data.flash);
      }
      return $q.reject(response);
    };

    return function(promise) {
      return promise.then(success, error);
    };
  };

  return {
    login: function(credentials)
    {
      var login = $http.post("api/v1/auth/login", sanitizeCredentials(credentials));
      login.success(cacheSession);
      login.success(FlashService.clear);
      login.error(loginError);
      return login;
    },
    logout: function() {
      var logout = $httpProvider.get("api/v1/auth/logout");
      logout.success(uncacheSession);
      return logout;
    },
    isLoggedIn: function() {
      return SessionService.get('authenticated');
    },
    validate: function() {
      $httpProvider.responseInterceptors.push(logsOutUserOn401);
    }
  };
}]);

pennantsApp.controller('LoginController', [
  '$scope',
  '$location',
  '$rootScope',
  '$window',
  'authenticationService',

  function($scope, $location, $rootScope, $window, AuthenticationService)
  {
    $scope.credentials = { username: "", password: "", rememberme: $scope.rememberme };

    $scope.rememberme = true;
    $scope.submit = function() {
      $scope.preventDefault;
      AuthenticationService.login($scope.credentials)
        .success(function() {
          $location.path('/dashbaord');
        })
        .error(function() {
          $rootScope.error = "Failed to login";
        }
      );
    };

    $scope.loginOauth = function(provider) {
      $window.location.href = '/auth/' + provider;
    };
  }
]);