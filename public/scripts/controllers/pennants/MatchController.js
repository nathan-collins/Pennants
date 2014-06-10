var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('MatchHostController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var hostId = Pennants.hostId;

  $http.get('/api/v1/pennants/match/host/'+seasonId+'/'+gradeId+'/'+hostId).success(function(matches) {
    $scope.matches = matches;
  });

  $scope.hostId = hostId;
});

pennantsApp.controller('AddMatchController', function($scope, $http, $cookies, $filter) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var hostId = Pennants.hostId;
  var timeFilter = $filter('date');

  $scope.game_time = new Date();
  $scope.game_time.setHours( 6 );
  $scope.game_time.setMinutes( 0 );

  $scope.hstep = 1;
  $scope.mstep = 5;

  $scope.clear = function() {
    $scope.game_time = null;
  }

  $scope.ismeridian = true;
  $scope.toggleMode = function() {
    $scope.ismeridian = ! $scope.ismeridian;
  };

  $scope.changed = function () {
    $scope.match.game_time = timeFilter($scope.game_time, "HH:mm");
  };

  $scope.addMatch = function(match, AddMatchForm) {
    match.season_id = seasonId;
    match.grade_id = gradeId;
    match.club_id = match.club_id.id;
    match.game_id = Pennants.hostId;
    match.opponent_id = match.opponent_id.id;

    $http.post('/api/v1/pennants/match', match).success(function() {
      $scope.reset();
      window.location = "/dashboard/pennants/match/"+Pennants.hostId;
    });

    $scope.reset = function() {
      $scope.match = angular.copy($scope.master);
    }
  }

  $scope.hostId = hostId;
});