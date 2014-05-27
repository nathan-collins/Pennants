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

      if(!clubsCache) {
        $http.get('/api/v1/pennants/club/season/'+seasonId+'/'+gradeId).success(function(clubs) {
          $scope.clubs = clubs;
        });
      } else {
        $scope.clubs = clubsCache;
      }
    }
  }
});

pennantsApp.directive('clubmatchselect', function($cookies, $http, $cacheFactory) {
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
      var hostId = Pennants.hostId;

      $http.get('/api/v1/pennants/club/match/'+seasonId+'/'+gradeId+'/'+hostId).success(function(clubs) {
        $scope.clubs = clubs;
      });
    }
  }
});

pennantsApp.directive('filteredclubselect', function($cookies, $http, $cacheFactory) {
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

      $http.get('/api/v1/pennants/club/host/'+seasonId+'/'+gradeId+'/').success(function(clubs) {
        $scope.clubs = clubs;
      });
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