var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ngRoute'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('ResultController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var matchId = Pennants.matchId;

  $http.get('/api/v1/pennants/results/season/'+seasonId+'/'+gradeId+'/'+matchId).success(function(results) {
    $scope.results = results;
  });

  $scope.matchId = matchId;
});

pennantsApp.controller('TeamController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(players) {
    $scope.players = players;
  });
});


pennantsApp.controller('OpponentController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var opponentId = Pennants.opponentId;

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+opponentId).success(function(players) {
    $scope.players = players;
  });
});