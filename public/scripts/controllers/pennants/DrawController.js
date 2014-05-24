var pennantsApp = angular.module('pennantsApp', ['ngCookies', 'ui.bootstrap'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('DrawController', function($scope, $http) {
  $scope.getRatings = function(clubId, clubName) {
    $scope.clubId = clubId;
    $scope.clubName = clubName;
    $('#display-info').show();
    $('#display-info .widget').slideUp();
    $('#hoverable').addClass('fa fa-spinner fa-4 fa-spin');
    $http.get('/api/v1/pennants/rating/club/'+clubId).success(function(ratings) {
      $scope.ratings = ratings;
      $('#hoverable').removeClass('fa fa-spinner fa-4 fa-spin');
      $('#display-info .widget').slideDown();
    });
  }
});

/**
 * Club Controller inside the tab
 */

pennantsApp.controller('ClubController', function($scope, $http, $cookies, $rootScope,  $modal) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  $http.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId).success(function(clubs) {
    $scope.clubs = clubs;
  });

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

pennantsApp.controller('MatchController', function($scope, $http, $cookies)
{
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var hostId = Pennants.clubId;

  $http.get('/api/v1/pennants/match/season/'+seasonId+'/'+gradeId+'/'+hostId).success(function(matches) {
    $scope.matches = matches;
  });

  $scope.hostId = hostId;
});

pennantsApp.config(function($httpProvider) {
  $httpProvider.interceptors.push(function($q, $rootScope) {
    return {
      'request': function(config) {
        $rootScope.$broadcast('loading-started');
        return config || $q.when(config);
      },
      'response': function(response) {
        $rootScope.$broadcast('loading-complete');
        return response || $q.when(response);
      }
    }
  })
});

$(function() {
  $('#display-info').hide();
});