var pennantsApp = angular.module('pennantsApp', ['ngCookies'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

function MatchController($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $http.get('/api/v1/pennants/match/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(matches) {
    $scope.matches = matches;
  });

  $scope.page =
  {
    title: 'Pennants - Matches'
  }
}

function AddMatchController($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  $scope.page =
  {
    title: 'Pennants - Add A Matches'
  }
}