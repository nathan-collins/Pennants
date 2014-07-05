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
          console.log(player);
          scope.player = player.name+' ('+player.handicap+')';
          cache.put('/api/v1/pennants/player/'+attr.playerId, player.name);
        });
      } else {
        scope.player = cacheData;
      }
    }
  }
});