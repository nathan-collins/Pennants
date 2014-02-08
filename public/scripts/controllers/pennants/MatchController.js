define(['appModule'], function(app) {
  app.lazy.controller('MatchController',
    [
      '$scope',
      '$http',
      '$cookies',

      function($scope, $http, $cookies) {
        var seasonId = $cookies.pennantsSeason;
        var gradeId = $cookies.pennantsGrade;

        $http.get('/api/v1/pennants/match/season/'+seasonId+'/'+gradeId+'/'+gameId).success(function(matches) {
          $scope.matches = matches;
        });

        $scope.page =
        {
          title: 'Pennants - Matches'
        }
      }
    ]
  )
})