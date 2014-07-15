var pennantsApp = angular.module('pennantsApp', ["ngCookies", "ui.bootstrap"], function($interpolateProvider) {
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

      $scope.seasonDisplay = true;

      $scope.storeGrade = function(gradeId) {
        // Set the season we are using
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

    function($scope, $http, $cookies)
    {
      var seasonId = $cookies.pennantsSeason;

      if(_.isUndefined(seasonId)) {

      }

      $scope.addGrade = function(grade) {

        grade.season_id = seasonId;

        $http.post('/api/v1/pennants/grade', grade).success(function() {
          $scope.reset();
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
    '$cookies',

    function($scope, $http, $cookies) {

      var seasonId = $cookies.pennantsSeason;
      var gradeId = Pennants.gradeId;

      $scope.settingsHandicapped = "all";

      $http.get('/api/v1/pennants/grade/'+gradeId).success(function(grade) {
        $scope.grade = grade;
        $scope.grade.settings = angular.fromJson(grade.settings);


      });

      $scope.editGrade = function(grade) {

        console.log(grade);
        grade.settings = {
          home_away: grade.settings.home_away,
          players: grade.settings.players,
          reserves: grade.settings.reserves,
          handicapped: grade.settings.handicapped
        }

        console.log(grade);

//        delete(grade.settings.home_away);
//        delete(grade.settings.players);
//        delete(grade.settings.reserves);
//        delete(grade.settings.handicapped);

        $http.put('/api/v1/pennants/grade/'+gradeId, grade).success(function() {

        });
      }
    }
  ]
);