var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ngRoute'], function($interpolateProvider) {
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

  $scope.page =
  {
    title: 'Pennants - Matches'
  }
})


pennantsApp.controller('AddPlayerController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  if(_.isUndefined(seasonId)) {
    $location.path('/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/pennants/grade')
  }

  $scope.clubId = clubId;

  $scope.addPlayer = function(player, AddPlayerForm) {
    player.season_id = seasonId;
    player.grade_id = gradeId;
    player.club_id = clubId;

    $http.post('/api/v1/pennants/player', player).success(function() {
      $scope.reset();
      $scope.activePath = $location.path('/pennants/player')
    });

    $scope.reset = function() {
      $scope.player = angular.copy($scope.master);
    }

  }


});