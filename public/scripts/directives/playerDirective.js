pennantsApp.directive('playerText', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {

      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/player/'+attr.playerId);

      cache.remove('/api/v1/pennants/player/'+attr.playerId);

      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      if(!cacheData) {
        $http.get('/api/v1/pennants/player/'+attr.playerId).success(function(player) {
          scope.player = player.name+' ('+player.handicap+')';
          cache.put('/api/v1/pennants/player/'+attr.playerId, player.name);
        });
      } else {
        scope.player = cacheData;
      }
    }
  }
});

pennantsApp.directive('playerResultText', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {

      var cache = $cacheFactory.get('$http');
      var cacheData = cache.get('/api/v1/pennants/player/result/'+Pennants.seasonId+'/'+Pennants.gradeId+'/'+attr.playerId);

      cache.remove('/api/v1/pennants/player/result/'+Pennants.seasonId+'/'+Pennants.gradeId+'/'+attr.playerId);

      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      if(!cacheData) {
        $http.get('/api/v1/pennants/player/result/'+Pennants.seasonId+'/'+Pennants.gradeId+'/'+attr.playerId).success(function(player) {
          scope.player = player.name+' ('+player.handicap+')';
          cache.put('/api/v1/pennants/player/result/'+Pennants.seasonId+'/'+Pennants.gradeId+'/'+attr.playerId, player.name);
        });
      } else {
        scope.player = cacheData;
      }
    }
  }
});

pennantsApp.directive('playerMatchClubText', function($cookies, $http, $cacheFactory) {
  var SLASH = "/";
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {

      var cache = $cacheFactory.get('$http');
      var path = '/api/v1/pennants/player/match/'+Pennants.seasonId+SLASH+Pennants.gradeId+SLASH+Pennants.clubId+SLASH+Pennants.matchId+SLASH+attr.playerId;
      var cacheData = cache.get(path);

      console.log(cacheData);

      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      if(!cacheData) {
        $http.get(path).success(function(player) {
          scope.player = player.name+' ('+player.handicap+')';
          cache.put(path, scope.player);
        });
      } else {
        scope.player = cacheData;
      }
    }
  }
});

pennantsApp.directive('playerMatchOpponentText', function($cookies, $http, $cacheFactory) {
  var SLASH = "/";
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {

      var cache = $cacheFactory.get('$http');
      var path = '/api/v1/pennants/player/match/'+Pennants.seasonId+SLASH+Pennants.gradeId+SLASH+Pennants.opponentId+SLASH+Pennants.matchId+SLASH+attr.playerId;
      var cacheData = cache.get(path);

      console.log(cacheData);

      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      if(!cacheData) {
        $http.get(path).success(function(player) {
          scope.player = player.name+' ('+player.handicap+')';
          cache.put(path, scope.player);
        });
      } else {
        scope.player = cacheData;
      }
    }
  }
});