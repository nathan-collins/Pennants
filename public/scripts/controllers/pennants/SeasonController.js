define(['appModule', 'services/flashService', 'config/navigation'], function(app, FlashService, navigation)
{
  app.lazy.controller('SeasonController',
    [
      '$scope',
      '$http',
      '$cookies',

      function($scope, $http, $cookies)
      {
        $http.get('/api/v1/pennants/season').success(function(seasons) {
          $scope.seasons = seasons;
        });

        $scope.page =
        {
          title: 'Pennants'
        }

        $scope.store = function(seasonId) {
          // Set the season we are using
          $cookies.pennantsSeason = seasonId;
        }
      }
    ]
  );

  app.lazy.controller('AddSeasonController',
    [
      '$scope',
      '$http',
      '$location',

      function($scope, $http, $location)
      {
        $scope.master = {};
        $scope.activePath = null;

        $scope.page =
        {
          title: 'Pennants - Add Season'
        }

        $scope.addSeason = function(season, AddSeasonForm) {

//            $scope.seasons.push(season);

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
    ]
  );

  app.lazy.controller('EditSeasonController',
    [
      '$scope',
      '$http',
      '$routeParams',
      '$location',

      function($scope, $http, $routeParams, $location)
      {
        $scope.page =
        {
          title: 'Pennants - Edit Season'
        }

        $scope.editSeason = function() {

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
    ]
  )
})