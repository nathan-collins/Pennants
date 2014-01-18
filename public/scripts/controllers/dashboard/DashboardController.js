define(['appModule'], function(app)
{
  app.lazy.controller('DashboardController',
  [
    '$scope',

    function($scope)
    {
      $scope.page =
      {
        title: 'Dashboard'
      }
    }
  ])
})