define(['appModule'], function(app) {
  app.lazy.controller('PlayerController',
    [
      '$scope',
      '$http',
      '$cookies',

      function($scope, $http, $cookies) {
        var seasonId = $cookies.pennantsSeason;
        var gradeId = $cookies.pennantsGrade;


      }
    ]
  )
});