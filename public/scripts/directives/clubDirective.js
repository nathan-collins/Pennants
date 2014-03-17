pennantsApp.directive('clubselect', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'E',
    scope: {
      id: '@',
      model: '=',
      name: '@'
    },
    template: "<select ng-options='club.name for club in clubs'></select>",
    replace: true,
    link: function($scope, elem, attr) {

      var seasonId = $cookies.pennantsSeason;
      var gradeId = $cookies.pennantsGrade;

      var cache = $cacheFactory.get('$http');

      var clubsCache = cache.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId);

      function intersects(a, b) {
        var i = 0, len = a.length, inboth = [];

        for (i; i < len; i++) {
          if (b.indexOf(a[i]) !== -1) inboth.push(a[i]);
        }

        return inboth.length > 0;
      }

      if(!clubsCache) {
        $http.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId).success(function(clubs) {
          $scope.clubs = clubs;
        });
      } else {
        $scope.clubs = clubsCache;
      }

      var existingClubs = cache.get('/api/v1/pennants/game/season/'+seasonId+'/'+gradeId);

      if(!existingClubs) {
        $http.get('/api/v1/pennants/game/season/'+seasonId+'/'+gradeId).success(function(hostClubs) {
          $scope.hostClubs = hostClubs;
          cache.put('/api/v1/pennants/game/season/'+seasonId+'/'+gradeId, hostClubs);
        });
      } else {
        $scope.hostClubs = existingClubs;
      }

      $scope.clubsFilter = function(clubs) {
        if($scope.hostClubs.length === 0) return true;
        return intersects($scope.hostClubs.host_id, clubs.id)
      }
    }
  }
});

pennantsApp.directive('clubText', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      club_id: '@'
    },
    template: '{{club}}',
    link: function(scope, elem, attr) {
      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/club/'+attr.clubId);

      cache.remove('/api/v1/pennants/club/'+attr.clubId);

      if(!cacheData) {
        $http.get('/api/v1/pennants/club/'+attr.clubId).success(function(club) {
          scope.club = club.name;
          cache.put('/api/v1/pennants/club/'+attr.clubId, club.name);
        });
      } else {
        scope.club = cacheData;
      }
    }
  }
});