scg.config(function($routeProvider) {
  $routeProvider.
      when('/pennants/season/create', {
        templateUrl: 'templates/season/create.html',
        controller: 'CreateSeasonController'
      }).
      when('/pennants/season/edit', {
        templateUrl: 'templates/season/edit.html',
        controller: 'EditSeasonController'
      }).
      when('/pennants/season', {
        templateUrl: 'templates/season/show.html',
        controller: 'ShowSeasonController'
      })
  }
);

scg.run(function($location) {

})

scg.controller('ShowSeasonController', function($scope, $http) {
  $http.get('/api/v1/pennants/season')
    .success(function(seasons) {
      $scope.seasons = seasons;
    }).
    error(function(data, status, headers, config) {

    }
  );
});

scg.controller('CreateSeasonController', function($scope, $http, $location) {

  $scope.addSeason = function() {
    var season = {
      year: $scope.seasonYear,
      name: $scope.seasonName
    }

    $http.post('/api/v1/pennants/season', season).success(function(season) {
      $location.path( "season" );
    }).
    error(function(data, status) {
      console.log(status);
    });
  }
});
