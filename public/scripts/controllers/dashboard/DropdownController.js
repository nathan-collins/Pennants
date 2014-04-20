angular.module('pennantsApp', ['ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

function DropdownController($scope) {
  $scope.notifications = [{
    title: "Your sleeping in the dog house",
    time_lapse: "1 minute Ago"
  },
  {
    title: "Get the bread",
    time_lapse: "5 minutes ago"
  }];

  $scope.user = [{
    icon: 'fa-user',
    name: "Profile"
  },
  {
    icon: "fa-cog",
    name: "Settings"
  },
  {
    icon: "fa-power-off",
    name: "Logout"
  }]
}