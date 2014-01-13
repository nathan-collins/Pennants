var scg = angular.module('scg', ['ui.bootstrap']);

function PageContainer($scope) {
  $scope.isCollapsed = false;
};

function NavigationController($scope) {
  console.log($scope);
}