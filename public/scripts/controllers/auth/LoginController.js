define(['appModule'], function(app)
{
  app.lazy.controller('LoginController',
    [
      '$scope',

      function($scope)
      {
        $scope.credentials = { username: "", password: "" };

        $scope.login = function() {
          AuthenticationService.login($scope.credentials).success(function() {
            $location.path('/');
          });
        };
      }
    ])
})