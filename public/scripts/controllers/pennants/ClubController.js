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

  $scope.addClub = function(club) {

    if(_.isUndefined(club)) {
      var club = {};
    }

    club.season_id = seasonId;
    club.grade_id = gradeId;

    $http.post('/api/v1/pennants/club', club).success(function(data) {

      $scope.data = data;
      $scope.loading = true;

      $scope.reset();
    }).error(function(data, status, headers, config) {
      // This will display the error messages
    }).then(function( response ) {
      $http.get('/api/v1/pennants/rating/fetch/'+$scope.data.club.id).success(function(data) {
        if(data.code == 200) {
          $scope.loading = false;
          alert("Seemed to work");
        } else {
          $scope.loading = false;
          alert("Something wrong");
        }
      }).error(function() {
        $http.get('/api/v1/pennants/club/status/disabled/'+$scope.data.club.id).success(function() {
          alert('Club Disabled');
        });
      });
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

  var clubId = $routeParams.clubId;
});


pennantsApp.controller('ClubMatchController', function($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $http.get('/api/v1/pennants/match/club/'+seasonId+'/'+gradeId+'/'+clubId).success(function(matches) {
    console.log(matches);
    angular.forEach(matches, function(match, key) {
      matches[key].versus = _.isEqual(Pennants.clubId, matches[key].club_id) ? matches[key].opponent_id : matches[key].club_id;
    });
    console.log(matches);
    $scope.matches = matches;
  });

  $scope.clubId = clubId;
});

/**
 *
 */
pennantsApp.controller('ClubPlayerController', function($scope, $http, $cookies)
{
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = Pennants.clubId;

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(players) {
    $scope.players = players;
  });

  $scope.clubId = clubId;
});
