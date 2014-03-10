define(['appModule'], function(app) {
  app.lazy.directive('seasonDisplay',function($cookies, $http, $cacheFactory) {
      return {
        restrict: 'A',
        scope: {
          model: '='
        },
        template: '<h2>{{season.name}}</h2><h4>Year: {{season.year}}</h4>',
        link: function($scope, element, attrs) {
          var seasonId = $cookies.pennantsSeason;

          var cache = $cacheFactory.get('$http');

          var cacheData = cache.get('/api/v1/pennants/season/'+seasonId);

          if(!cacheData) {
            $http.get('/api/v1/pennants/season/'+seasonId, {cache: true}).success(function(season) {
              $scope.season = season;
              cache.put('/api/v1/pennants/season/'+seasonId, season);
            });
          } else {
            $scope.season = cacheData;
          }
        }
      }
    }
  );
});