var pennantsApp = angular.module('pennantsApp', [], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('DashboardController', [
  '$scope',

  function($scope)
  {

  }
]);