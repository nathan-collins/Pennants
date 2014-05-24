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

pennantsApp.controller('AddMatchController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var hostId = Pennants.hostId;

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

  $scope.addMatch = function(match, AddMatchForm) {
    match.seasonId = seasonId;
    match.gradeId = gradeId;

    $http.post('/api/v1/pennants/match', match).success(function() {
      $scope.reset();
    });

    $scope.reset = function() {
      $scope.match = angular.copy($scope.master);
    }
  }

  $scope.hostId = hostId;
});