var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.factory('playerFactory', function($http) {
  return {
    get: function(url) {
      return $http.get(url, {params: {sensor: false}}).then(function(resp) {
        return resp.data; // success callback returns this
      });
    }
  }
});


pennantsApp.controller('PlayerController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
})


pennantsApp.controller('AddPlayerController', function($scope, $http, $cookies, playerFactory) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $scope.clubId = clubId;

  $('.typeahead').removeClass('dropdown-menu');

  $scope.addPlayer = function(player, AddPlayerForm) {
    player.season_id = seasonId;
    player.grade_id = gradeId;
    player.club_id = clubId;

    $http.post('/api/v1/pennants/player', player).success(function() {
      $scope.reset();
    });

    $scope.reset = function() {
      $scope.player = angular.copy($scope.master);
    }

  }

  $scope.getPlayer = function(val) {
    playerFactory.get('/api/v1/pennants/player/search/'+val)
      .then(function(data) {
        $scope.open=false;
        $scope.loadingPlayers = false;
        $scope.player.show_name=false;
        if(_.size(data) > 0) {
          $scope.player.show=true;
        } else {
          $scope.player.show=false;
        }
        console.log(data);
        $scope.players = data;
      }
    );
  }

  $scope.populateSettings = function(player) {
    $scope.player.playerId = player.player_id;
    $scope.player.player_name = player.name;
    $scope.player.handicap = player.handicap;
    $scope.player.golf_link_number = player.golf_link_number;

    $scope.player.show_name=true;
  }

  $scope.clearPlayer = function() {
    delete($scope.player.playerId);
    $scope.player.player_name = '';
    $scope.player.handicap = '';
    $scope.player.golf_link_number = '';

    $scope.player.show_name=false;
  }
});