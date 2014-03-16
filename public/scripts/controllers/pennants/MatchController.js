var pennantsApp = angular.module('pennantsApp', ['ngCookies'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('MatchController',
  [
    '$scope',
    '$http',
    '$cookies',

    function($scope, $http, $cookies) {
      var seasonId = $cookies.pennantsSeason;
      var gradeId = $cookies.pennantsGrade;

      $http.get('/api/v1/pennants/match/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(matches) {
        $scope.matches = matches;
      });

      $scope.page =
      {
        title: 'Pennants - Matches'
      }
    }
  ]
),

pennantsApp.controller('AddMatchController',
  [
    '$scope',
    '$http',
    '$cookies',

    function($scope, $http, $cookies) {
      var seasonId = $cookies.pennantsSeason;
      var gradeId = $cookies.pennantsGrade;

      $scope.page =
      {
        title: 'Pennants - Add A Matches'
      }
    }
  ]
);