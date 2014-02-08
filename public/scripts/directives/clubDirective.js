define(['appModule'], function(app) {
  app.lazy.directive('clubselect', function($cookies, $http) {
    return {
      restrict: 'E',
      scope: {
        id: '@',
        options: '=',
        model: '=',
        name: '@'
      },
      template: "<select ng-options='club.name for club in clubs'></select>",
      replace: true,
      link: function(scope, elem, attr) {

        var seasonId = $cookies.pennantsSeason;
        var gradeId = $cookies.pennantsGrade;

        $http.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId).success(function(clubs) {
          scope.clubs = clubs;
        });
      }
    }
  });

  app.lazy.directive('clubText', function($cookies, $http) {
    return {
      restrict: 'A',
      scope: {
        id: '@',
        club_id: '@'
      },
      template: '{{club.name}}',
      link: function(scope, elem, attr) {
        $http.get('/api/v1/pennants/club/'+attr.clubId).success(function(club) {
          scope.club = club;
        });
      }
    }
  });
})