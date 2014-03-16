var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ngRoute'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});


function PlayerController($scope, $http, $cookies, $routeParams) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var clubId = $routeParams.clubId;

  $http.get('/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+clubId).success(function(players) {
    $scope.players = players;
  });

  $scope.page =
  {
    title: 'Pennants - Matches'
  }
}


function PlayerAddController($scope, $http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;


}