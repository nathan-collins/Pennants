define(['appModule'], function(app) {
  app.lazy.directive('gradeDisplay',function($cookies, $http) {
      return {
        restrict: 'A',
        template: '<h4>Grade: {{grade.name}}</h4>',
        link: function($scope, element, attrs) {
          var gradeId = $cookies.pennantsGrade;
          $http.get('/api/v1/pennants/grade/'+gradeId).success(function(grade) {
            $scope.grade = grade;
          });
        }
      }
    }
  );
});