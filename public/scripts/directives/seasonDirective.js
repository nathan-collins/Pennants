pennantsApp.directive('seasonDisplay', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'A',
    scope: {
      model: '='
    },
    template: '<h2><% season.name %></h2><h4>Year: <% season.year %></h4>',
    link: function($scope, element, attrs) {
      var seasonId = $cookies.pennantsSeason;

      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/season/'+seasonId);

      console.log(cacheData);

      if(!cacheData) {
        $http.get('/api/v1/pennants/season/'+seasonId, {cache: true})
          .success(function(season) {
            $scope.season = season;
            cache.put('/api/v1/pennants/season/'+seasonId, season);
          }
        )
          .error(function(data, status, headers, config) {

          }
        );
      } else {
        $scope.season = cacheData;
      }
    }
  }
});

pennantsApp.directive('seasonConcat', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      season_id: '@'
    },
    template: '<% season.name %> (<% season.year %>)',
    link: function($scope, element, attr) {
      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/season/'+attr.seasonId);

      if(!cacheData) {
        $http.get('/api/v1/pennants/season/'+attr.seasonId, {cache: true}).success(function(season) {
          $scope.season = season;
          cache.put('/api/v1/pennants/season/'+attr.seasonId, season);
        });
      } else {
        $scope.season = cacheData;
      }
    }
  }
});

pennantsApp.directive('seasonSelect', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      model: '=',
      name: '@'
    },
    template: "<select ng-options='season.name for season in seasons'></select>",
    replace: true,
    link: function(scope, elem, attr) {
      var cache = $cacheFactory.get('$http');

      var seasonsCache = cache.get('/api/v1/pennants/season');

      if(!seasonsCache) {
        $http.get('/api/v1/pennants/season').success(function(seasons) {
          scope.seasons = seasons;
        });
      } else {
        scope.seasons = seasonsCache;
      }
    }
  }
});


pennantsApp.directive('seasonText', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      season_id: '@'
    },
    template: '<% season %>',
    link: function(scope, elem, attr) {
      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/season/'+attr.seasonId);

      if(!cacheData) {
        $http.get('/api/v1/pennants/season/'+attr.seasonId).success(function(season) {
          scope.season = season.name + ' ('+ season.year + ')';
          cache.put('/api/v1/pennants/season/'+attr.seasonId, season.name);
        });
      } else {
        scope.season = cacheData;
      }
    }
  }
});