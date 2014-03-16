pennantsApp.directive('gradeDisplay', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'A',
    template: '<h4>Grade: <% grade.name %></h4>',
    link: function($scope, element, attrs) {
      var gradeId = $cookies.pennantsGrade;

      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/grade/'+gradeId);

      if(!cacheData) {
        $http.get('/api/v1/pennants/grade/'+gradeId).success(function(grade) {
          $scope.grade = grade;
          cache.put('/api/v1/pennants/grade/'+gradeId, grade);
        });
      } else {
        $scope.grade = cacheData;
      }
    }
  }
});