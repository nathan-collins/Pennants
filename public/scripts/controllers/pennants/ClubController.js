var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ngRoute'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

function ClubController($scope, $http, $cookies, $routeParams) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  var clubId = $routeParams.clubId;

  $http.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId).success(function(clubs) {
    $scope.clubs = clubs;
  });

  $scope.page =
  {
    title: 'Pennants'
  }
}

function AddClubController($scope, $http, $cookies, $location, $routeParams) {

  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  var clubId = $routeParams.clubId;

  if(_.isUndefined(seasonId)) {
    $location.path('/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/pennants/grade')
  }


  $scope.addClub = function(club) {

    club.season_id = seasonId;
    club.grade_id = gradeId;

    $http.post('/api/v1/pennants/club', club).success(function() {
      $scope.reset();
      $scope.activePath = $location.path('/pennants/draws')
    });

    $scope.reset = function() {
      $scope.season = angular.copy($scope.master);
    }
  }
}

function EditClubController($scope, $http, $routeParams, $cookies, $location) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  if(_.isUndefined(seasonId)) {
    $location.path('/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/pennants/grade')
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
      $location.path('/pennants/draws')
    })
      .error(function(data) {
        FlashService.show(data.message);
      });
  }
}


function ClubListController($scope, $http, $routeParams, $cookies, $location) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  if(_.isUndefined(seasonId)) {
    $location.path('/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/pennants/grade')
  }

  var clubId = $routeParams.clubId;
}