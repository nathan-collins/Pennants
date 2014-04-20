var pennantsApp = angular.module('pennantsApp', ['ngCookies'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});


pennantsApp.controller('ClubController', ['$scope', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  $http.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId).success(function(clubs) {
    $scope.clubs = clubs;
  });
}]);

pennantsApp.controller('AddClubController', function($scope, $http, $cookies, $location) {

  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  if(_.isUndefined(seasonId)) {
    $location.path('/dashboard/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/dashboard/pennants/grade')
  }


  $scope.addClub = function(club) {

    club.season_id = seasonId;
    club.grade_id = gradeId;

    $http.post('/api/v1/pennants/club', club).success(function() {
      $scope.reset();
      $scope.activePath = $location.path('/dashboard/pennants/draws')
    });

    $scope.reset = function() {
      $scope.season = angular.copy($scope.master);
    }
  }
});

pennantsApp.controller('EditClubController', function($scope, $http, $routeParams, $cookies, $location) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  if(_.isUndefined(seasonId)) {
    $location.path('/dashboard/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/dashboard/pennants/grade')
  }

  var clubId = $routeParams.clubId;

  $http.get('/api/v1/pennants/club/'+clubId).success(function(club) {
    $scope.club = club;
  })
    .error(function(data) {
      FlashService.show(data.message);
    }
  );

  $scope.editClub = function() {

    var club = {
      name: $scope.name,
      id: clubId
    }

    $scope.clubs.push(club);

    $http.post('/api/v1/pennants/club/'+clubId, club).success(function() {
      $location.path('/dashboard/pennants/draws')
    })
      .error(function(data) {
        FlashService.show(data.message);
      });
  }
});


pennantsApp.controller('ClubListController', function($scope, $http, $routeParams, $cookies, $location) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  if(_.isUndefined(seasonId)) {
    $location.path('/dashboard/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/dashboard/pennants/grade')
  }

  var clubId = $routeParams.clubId;
});