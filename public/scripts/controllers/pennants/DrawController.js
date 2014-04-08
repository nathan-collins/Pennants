var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('DrawController', ['$scope', function($scope) {

}]);

/**
 * Club Controller inside the tab
 */

pennantsApp.controller('ClubController', function($scope, $http, $cookies, $rootScope,  $modal) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  $http.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId).success(function(clubs) {
    $scope.clubs = clubs;
  });

  $scope.page =
  {
    title: 'Pennants'
  }

  $scope.launch = function(clubId) {
    var modalInstance = $modal.open({
      templateUrl: "/api/v1/pennants/rating/fetch/" + clubId,
      controller: 'RatingFetchController',
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
});

pennantsApp.controller('GameController', function($scope, $http, $cookies, $cacheFactory)
{
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  var cache = $cacheFactory.get('$http');

  var cacheData = cache.get('/api/v1/pennants/game/season/'+seasonId+'/'+gradeId);

  if(!cacheData) {
    $http.get('/api/v1/pennants/game/season/'+seasonId+'/'+gradeId).success(function(games) {
      $scope.games = games;

      cache.put('/api/v1/pennants/game/season/'+seasonId+'/'+gradeId, games);
    });
  } else {
    $scope.games = cacheData;
  }
});

pennantsApp.controller('RatingFetchController', function()
{

});