var pennantsApp = angular.module('pennantsApp', ["ngCookies", 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.factory('CompetitionFactory', function($http) {
  return {
    get: function(url) {
      return $http.get(url, {params: {sensor: false}}).then(function(resp) {
        return resp.data; // success callback returns this
      });
    }
  }
});

function SeasonController($scope, $http, $cookies) {

  $http.get('/api/v1/pennants/season').success(function(seasons) {
    $scope.seasons = seasons;
    // Group the results to seperate in a header
    $scope.groups = _.groupBy($scope.seasons, "year");
  });

  $scope.storeSeason = function(seasonId) {
    // Set the season we are using
    $cookies.pennantsSeason = seasonId;
  }

  $scope.destroySeason = function(seasonId) {
    $http.delete('/api/v1/pennants/season', {seasonId: seasonId}).success(function(seasons) {

    });
  }
};

function AddSeasonController($scope, $http, CompetitionFactory) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.addSeason = function(season, AddSeasonForm) {

    season.competition_id = Pennants.competition_id;

    $http.post('/api/v1/pennants/season', season).success(function() {
      $scope.reset();
      window.location.href = "/dashboard/pennants/season";
    });

    $scope.reset = function() {
      $scope.season = angular.copy($scope.master);
    }

//          $scope.reset();
  }

  $scope.getCompetition = function(val) {
    CompetitionFactory.get('/api/v1/pennants/competition/search/'+val)
      .then(function(data) {
        $scope.open=false;
        $scope.loadingCompetitions = false;
        $scope.competition.show_name=false;
        if(_.size(data) > 0) {
          $scope.competition.show=true;
        } else {
          $scope.competition.show=false;
        }
        $scope.competitions = data;
      });
  }

  $scope.populateSettings = function(season) {
    $scope.season.competitionId = season.id;
    $scope.season.name = season.name;

    $scope.player.show_name=true;
  }
}

function EditSeasonController($scope, $http, $routeParams, $location) {

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