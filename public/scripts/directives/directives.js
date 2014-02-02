define(['appModule'], function(app) {
  app.lazy.directive('seasonDisplay',
    [
      function($cookies) {
        return {
          restrict: 'A',
          template: '<div class="jumbotron"><h1>{{data.name}}</h1></div>',
          scope: {
            seasonId: $cookies.pennantsSeason
          },
          link: function($scope, element, attrs) {
            $http.get('/api/v1/pennants/season/'+$scope.seasonId).success(function(data) {
              $scope.data = data
            });
          }
        }
      }
    ]
  );
});