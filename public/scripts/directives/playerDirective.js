pennantsApp.directive('playerText', function($cookies, $http) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {
      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      $http.get('/api/v1/pennants/player/'+attr.playerId).success(function(player) {
        scope.player = player.name+' ('+player.handicap+')';
      });
    }
  }
});

pennantsApp.directive('playerResultText', function($cookies, $http) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {
      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      $http.get('/api/v1/pennants/player/result/'+Pennants.seasonId+'/'+Pennants.gradeId+'/'+attr.playerId).success(function(player) {
        scope.player = player.name+' ('+player.handicap+')';
      });
    }
  }
});

pennantsApp.directive('playerMatchClubText', function($cookies, $http) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {
      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      $http.get('/api/v1/pennants/player/match/'+Pennants.seasonId+'/'+Pennants.gradeId+'/'+Pennants.clubId+'/'+Pennants.matchId+'/'+attr.playerId).success(function(player) {
        scope.player = player.name+' ('+player.handicap+')';
      });
    }
  }
});

pennantsApp.directive('playerMatchOpponentText', function($cookies, $http) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '<% player %>',
    link: function(scope, elem, attr) {

      if(attr.playerId == 0) {
        return scope.player = "No Opponent";
      }

      $http.get('/api/v1/pennants/player/match/'+Pennants.seasonId+'/'+Pennants.gradeId+'/'+Pennants.opponentId+'/'+Pennants.matchId+'/'+attr.playerId).success(function(player) {
        scope.player = player.name+' ('+player.handicap+')';
      });
    }
  }
});