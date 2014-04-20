var pennantsApp = angular.module('pennantsApp', ["ngCookies", "ui.bootstrap"], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

pennantsApp.controller('LeaderBoardController', function($scope, $http, $cookies) {
  var current_year = $('#season-year li.active a').text();

  $('#season-year li').each(function() {
    if($(this).text() == Pennants.year) {
      $(this).addClass('active');
    }
  });

  $('.tab-content div.active h3 span.current-year').append('('+current_year+')');

  $http.get('/api/v1/pennants/grade/season/'+Pennants.seasonId).success(function(grades) {
    var tabs = [];

    angular.forEach(grades, function(value, key) {
      this.push({title:"" + value.name + "", gradeId: value.id});
    }, tabs);

    $scope.tabs = tabs;
  });

  $scope.active = function() {
    var gradeId = $('.grade-tabs li.active').attr('gradeId');
    return gradeId;
  };

  $scope.$watch('active()', function(gradeId) {
    $http.get('/api/v1/pennants/club/season/'+Pennants.seasonId+'/'+gradeId).success(function(clubs) {
      $scope.clubs = clubs;
    });
  });
});

pennantsApp.controller('ShowLeaderBoard', function(seasonId, $scope, $http, $cookies) {
  $http.get('api/v1/pennants/season').success(function(seasons)
  {
    $scope.seasons = seasons;
  });
});

pennantsApp.controller('LeaderBoardLadder', function() {
  $http.get('/api/v1/pennants/season').success(function()
  {

  });
});