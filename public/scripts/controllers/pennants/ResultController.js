var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('ResultController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var matchId = Pennants.matchId;

  $http.get('/api/v1/pennants/result/match/'+seasonId+'/'+gradeId+'/'+matchId).success(function(results) {
    $scope.results = results;
  });
});

pennantsApp.controller('TeamController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $('.player-group button').prop('disabled', false);

  $scope.teamPlayer = function(playerId, status, clubId) {
    $('.player-group button').prop('disabled', true);

    $http.post('/api/v1/pennants/result',
      {
        status: status,
        player_id: playerId,
        match_id: Pennants.matchId,
        grade_id: $cookies.pennantsGrade,
        season_id: $cookies.pennantsSeason,
        club_id: clubId,
        player_type: 'player'
      }
    ).success(function() {
      $('.player-group button').prop('disabled', false);
    });
  }

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(players) {
    $scope.players = players;
  });
});


pennantsApp.controller('OpponentController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var opponentId = Pennants.opponentId;

  $('.player-group button').prop('disabled', false);

  $scope.opponentPlayer = function(playerId, status, clubId) {
    $('.player-group button').prop('disabled', true);

    $http.post('/api/v1/pennants/result',
      {
        status: status,
        versus_id: playerId,
        match_id: Pennants.matchId,
        grade_id: $cookies.pennantsGrade,
        season_id: $cookies.pennantsSeason,
        club_id: clubId,
        player_type: 'opponent'
      }
    ).success(function() {
      $('.player-group button').prop('disabled', false);
    });
  }

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+opponentId).success(function(players) {
    $scope.players = players;
  });
});