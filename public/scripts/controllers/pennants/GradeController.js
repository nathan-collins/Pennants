define(['appModule', 'services/flashService'], function(app, FlashService)
{
  app.lazy.controller('GradeController',
    [
      '$scope',
      '$http',
      '$cookies',

      function($scope, $http, $cookies)
      {
        var seasonId = $cookies.pennantsSeason;

        $http.get('/api/v1/pennants/grade/seasons/'+seasonId).success(function(grades) {
          $scope.grades = grades;
        });

        $scope.RightNavigation = "list";

        $scope.page =
        {
          title: 'Pennants'
        }

        $scope.store = function(gradeId) {
          // Set the season we are using
          $cookies.pennantsGrade = gradeId;
        }
      }
    ]
  );

  app.lazy.controller('AddGradeController',
    [
      '$scope',
      '$http',
      '$location',
      '$cookies',

      function($scope, $http, $location, $cookies)
      {
        var seasonId = $cookies.pennantsSeason;

        $scope.page =
        {
          title: 'Pennants - Add Grade'
        }

        if(_.isUndefined(seasonId)) {
          $location.path('/pennants/grade');
        }

        $scope.addGrade = function(grade) {

          grade.season_id = seasonId;

          console.log(grade);

          $http.post('/api/v1/pennants/grade', grade).success(function() {
            $scope.reset();
            $scope.activePath = $location.path('/pennants/grade');
          });

          $scope.reset = function() {
            $scope.season = angular.copy($scope.master);
          }
        }
      }
    ]
  );

  app.lazy.controller('EditGradeController',
    [
      '$scope',
      '$http',
      '$routeParams',
      '$location',
      '$cookies',

      function($scope, $http, $routeParams, $location, $cookies) {

        var seasonId = $cookies.pennantsSeason;

        $http.get('/api/v1/pennants/grade/'+gradeId).success(function(grade) {
          $scope.grade = grade;
        })
          .error(function(data) {
            FlashService.show(data.message);
          }
        );

        console.log($scope.grades);

        $scope.editGrade = function() {

          var grade = {
            year: $scope.year,
            name: $scope.name,
            id: gradeId
          }

          $scope.grades.push(grade);

          $http.post('/api/v1/pennants/grade/'+gradeId, grade).success(function() {
            $location.path('/pennants/grade')
          })
            .error(function(data) {
              FlashService.show(data.message);
            });
        }
      }
    ]
  );
});