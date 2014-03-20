var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('DrawController', ['$scope', function($scope) {
  $scope.getRatings = function() {
    var modalInstance = $modal.open({
      templateUrl: 'ratings.html',
      controller: modalInstanceCtrl,
      resolve: {
        items: function() {
          return $scope.items;
        }
      }
    });

    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function() {

    });
  }
}]);