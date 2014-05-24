var pennantsApp = angular.module('pennantsApp', ['ngCookies'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('TeamController',
  [
    '$scope',
    '$http',
    '$cookies',

    function($scope, $http, $cookies) {
      $http.get('/api/v1/pennants/team').success(function(seasons) {
        $scope.teams = seasons;
      });
    }
  ]
);