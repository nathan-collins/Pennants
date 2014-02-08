define(['appModule'], function(app) {
  app.lazy.controller('DrawController',
    [
      '$scope',

      function($scope) {
        $scope.RightNavigation = 'list';
//        $scope.tabs;
      }
    ]
  )
});