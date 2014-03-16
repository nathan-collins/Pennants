var pennantsApp = angular.module('pennantsApp', ['ngCookies'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

function DrawController() {

}