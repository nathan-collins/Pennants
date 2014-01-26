define(['appModule', 'services/flashService'], function(app, FlashService)
{
  app.lazy.controller('GradeController',
    [
      '$scope',
      '$http',
      '$cookies',

      function($scope, $http, $cookies)
      {
        $http.get('/api/v1/pennants/grade').success(function(seasons) {
          $scope.grades = grades;
        });

        $scope.page =
        {
          title: 'Pennants'
        }
      }
    ]
  )
});