define(['appModule'], function(app) {
  app.lazy.directive('seasonDisplay',function($cookies, $http) {
      return {
        restrict: 'A',
        scope: {
          model: '='
        },
        template: '<h2>{{season.name}}</h2><h4>Year: {{season.year}}</h4>',
        link: function($scope, element, attrs) {
          var seasonId = $cookies.pennantsSeason;
          $http.get('/api/v1/pennants/season/'+seasonId).success(function(season) {
            $scope.season = season;
          });
        }
      }
    }
  );
});