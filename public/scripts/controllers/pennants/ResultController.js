var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.config(['$httpProvider', function ($httpProvider) {
  $httpProvider.defaults.cache = true;
}]);

pennantsApp.controller('ResultController', function($scope, ResultService) {
  loadRemoteData();

  function loadRemoteData() {
    ResultService.getResults()
    .then(
      function( results ) {
        applyRemoteData(results);
      }
    );
  }

  // I apply the remote data to the local scope.
  function applyRemoteData( newResults ) {
    $scope.results = newResults;
  }

  $scope.setResult = function(playerId, score, clubId) {
    $http.put('/api/v1/pennants/results/',
      {
        player_id: playerId,
        score: score,
        club_id: clubId,
        match_id: Pennants.matchId,
        grade_id: $cookies.pennantsGrade,
        season_id: $cookies.pennantsSeason
      }
    ).success(function() {

    })
    .error(function(data) {

    });
  }
});

pennantsApp.controller('TeamController', function($scope, $http, $cookies, ResultService) {
  var settings = Pennants.settings;
  var limitPlayers = settings.players;

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
    ).success(function(data, status) {
      // We need to change the display so the player cannot be re-added again.
        $('.player-group button').prop('disabled', false);
    })
    .error(function(data) {
        $('.player-group button').prop('disabled', false);
        $('.error-message').show();
        $('.error-message').addClass('alert-'+data.type);
        $('.error-message p').text(data.message);

    });
  }

  loadRemoteData();

  function loadRemoteData() {
    ResultService.getTeamPlayers()
      .then(
      function( players ) {
        applyRemoteData(players);
      }
    );
  }

  // I apply the remote data to the local scope.
  function applyRemoteData( Players ) {
    $scope.players = Players;
  }
});


pennantsApp.controller('OpponentController', function($scope, $http, $cookies, ResultService) {
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
    })
    .error(function() {
        $('.player-group button').prop('disabled', false);
        $('.error-message').show();
    });
  }

  loadRemoteData();

  function loadRemoteData() {
    ResultService.getOpponentPlayers()
      .then(
      function( players ) {
        applyRemoteData(players);
      }
    );
  }

  // I apply the remote data to the local scope.
  function applyRemoteData( Players ) {
    $scope.players = Players;
  }
});