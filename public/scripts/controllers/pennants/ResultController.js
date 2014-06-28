var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
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
});

pennantsApp.controller('TeamController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $scope.teamPlayer = function(status, playerId) {
    _.debounce(function(e) {
      $http.post('/api/v1/pennants/player').success(function() {

      });
    }, 500);
  }

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(players) {
    $scope.players = players;
  });
});


pennantsApp.controller('OpponentController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var opponentId = Pennants.opponentId;

  $scope.opponentPlayer = function(status, playerId) {
    alert("Yes");
  }

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+opponentId).success(function(players) {
    $scope.players = players;
  });
});