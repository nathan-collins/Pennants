define(['appModule', 'services/flashService'], function(app, FlashService)
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
      '$routeParams',
      '$location',

      function($scope, $http, $routeParams, $location)
      {
        $scope.page =
        {
          title: 'Pennants - Add Season'
        }

        var seasonId = $routeParams.seasonId;

        if(_.isUndefined(seasonId)) {
          $scope.addSeason = function() {

            var season = {
              year: $scope.year,
              name: $scope.name
            }
            $scope.seasons.push(season);

            $http.post('/api/v1/pennants/season', season).success(function() {
              $location.path('/pennants/season')
            })
              .error(function(data) {
                FlashService.show(data.message);
              });
          }
        } else {

          $http.get('/api/v1/pennants/season/'+seasonId).success(function(season) {
            $scope.season = season;
          })
            .error(function(data) {
              FlashService.show(data.message);
            }
          );

          console.log($scope.seasons);

          $scope.editSeason = function() {

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
      }
    ]
  );
})