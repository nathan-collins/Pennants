var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});


pennantsApp.controller('PlayerController', function($scope, $http, $cookies, $routeParams) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(players) {
    $scope.players = players;
  });

  $scope.clubId = clubId;
})


pennantsApp.controller('AddPlayerController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $scope.clubId = clubId;

  $scope.selected = undefined;

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
    console.log(val);
    return $http.get('/api/v1/pennants/player', {
      params: {
        player: val,
        sensor: false
      }
    }).then(function(res) {
      var players = [];
      angular.forEach(res.data.results, function(item) {
        players.push(item.name);
      });
      return players;
    });
  }
});