define(['appModule'], function(app) {
  app.lazy.controller('TeamController',
    [
      '$scope',
      '$http',
      '$cookies',

      function($scope, $http, $cookies) {
        $http.get('/api/v1/pennants/team').success(function(seasons) {
          $scope.teams = seasons;
        });

        $scope.page =
        {
          title: 'Pennants'
        }
      }
    ]
  );
});