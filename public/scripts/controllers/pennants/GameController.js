var pennantsApp = angular.module('pennantsApp', ["ngCookies"], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

function GameController($scope, $http, $cookies, $cacheFactory)
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
}


function AddGameController($scope, $http, $cookies, $location) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;

  if(_.isUndefined(seasonId)) {
    $location.path('/pennants/season')
  }

  // Redirect back to grades so it can be assigned a value
  if(_.isUndefined(gradeId)) {
    $location.path('/pennants/grade')
  }

  $scope.today = function() {
    $scope.dt = new Date();
  };
  $scope.today();

  $scope.showWeeks = false;
  $scope.toggleWeeks = function () {
    $scope.showWeeks = ! $scope.showWeeks;
  };

  $scope.clear = function () {
    $scope.dt = null;
  };

  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };

  $scope.dateOptions = {
    'year-format': "'yy'",
    'starting-day': 1
  };

  $scope.formats = ['dd-MMMM-yyyy', 'yyyy-MM-dd', 'shortDate'];
  $scope.format = $scope.formats[0];

  $scope.addGame = function(game, AddGameForm) {
    game.season_id = seasonId;
    game.grade_id = gradeId;
    game.host_id = game.host.id;
    delete game.host;

    $http.post('/api/v1/pennants/game', game).success(function() {
      $scope.reset();
      $scope.activePath = $location.path('/pennants/draws')
    });

    $scope.reset = function() {
      $scope.season = angular.copy($scope.master);
    }
  };
}