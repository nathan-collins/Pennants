var pennantsApp = angular.module('pennantsApp', ['ngCookies'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('MatchController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var hostId = Pennants.hostId;

  $http.get('/api/v1/pennants/match/season/'+seasonId+'/grade/'+gradeId+'/host/'+hostId).success(function(matches) {
    $scope.matches = matches;
  });

  $scope.hostId = hostId;
});

pennantsApp.controller('AddMatchController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var hostId = Pennants.hostId;

  $scope.hostId = hostId;

  $scope.page =
  {
    title: 'Pennants - Add A Matches'
  }
});