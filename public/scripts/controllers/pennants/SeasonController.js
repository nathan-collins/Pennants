var pennantsApp = angular.module('pennantsApp', ["ngCookies"], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

function SeasonController($scope, $http, $cookies) {

  $http.get('/api/v1/pennants/season').success(function(seasons) {
    $scope.seasons = seasons;
    // Group the results to seperate in a header
    $scope.groups = _.groupBy($scope.seasons, "year");
  });

  $scope.page =
  {
    title: 'Pennants'
  }

  $scope.storeSeason = function(seasonId) {
    // Set the season we are using
    $cookies.pennantsSeason = seasonId;
  }

  $scope.destroySeason = function(seasonId) {
    $http.delete('/api/v1/pennants/season', {seasonId: seasonId}).success(function(seasons) {

    });
  }
};

function AddSeasonController($scope, $http, $location) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.page =
  {
    title: 'Pennants - Add Season'
  }

  $scope.addSeason = function(season, AddSeasonForm) {

    $http.post('/api/v1/pennants/season', season).success(function() {
      $scope.reset();
      $scope.activePath = $location.path('/pennants/season');
    });

    $scope.reset = function() {
      $scope.season = angular.copy($scope.master);
    }

//          $scope.reset();
  }
}

function EditSeasonController($scope, $http, $routeParams, $location) {
  $scope.page =
  {
    title: 'Pennants - Edit Season'
  }

  $scope.editSeason = function(seasonId) {

    $http.get('/api/v1/pennants/season/'+seasonId).success(function(season) {
      $scope.season = season;
    })
      .error(function(data) {
        FlashService.show(data.message);
      }
    );

    var seasonId = $routeParams.seasonId;

    var season = {
      year: $scope.year,
      name: $scope.name,
      id: seasonId
    }

    $scope.seasons.push(season);

    $http.post('/api/v1/pennants/season/'+seasonId, season).success(function() {
      $location.path('/pennants/season')
    })
      .error(function(data) {
        FlashService.show(data.message);
      });
  }
}