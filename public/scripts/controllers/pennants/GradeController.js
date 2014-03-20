var pennantsApp = angular.module('pennantsApp', ["ngCookies"], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('GradeController',
  [
    '$scope',
    '$http',
    '$cookies',

    function($scope, $http, $cookies)
    {
      var seasonId = $cookies.pennantsSeason;

      $http.get('/api/v1/pennants/grade/season/'+seasonId).success(function(grades) {
        $scope.grades = grades;
      });

      $scope.RightNavigation = "list";

      $scope.seasonDisplay = true;

      $scope.page =
      {
        title: 'Pennants'
      }

      $scope.store = function(gradeId) {
        // Set the season we are using
        console.log(gradeId);
        $cookies.pennantsGrade = gradeId;
      }

      $scope.deleteGrade = function(grade) {
        grade.seasonId = seasonId;

        $http.delete('/api/v1/pennants/grade/'+grade.id).success(function() {
          $scope.activePath = $location.path('/pennants/grade');
        })
      }
    }
  ]
);

pennantsApp.controller('AddGradeController',
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

pennantsApp.controller('EditGradeController',
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