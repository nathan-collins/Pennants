define(['appModule', 'services/authenticationService'], function(app, AuthenticationService)
{
  app.lazy.controller('LoginController',
    [
      '$scope',
      '$location',
      '$rootScope',
      '$window',

      function($scope, $location, $rootScope, $window)
      {
        $scope.credentials = { username: "", password: "", rememberme: $scope.rememberme };

        $scope.page = {
          title: "Login"
        }

        $scope.rememberme = true;
        $scope.login = function() {
          AuthenticationService.login($scope.credentials)
            .success(function() {
              $location.path('/');
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
})