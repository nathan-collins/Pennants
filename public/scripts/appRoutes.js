define([], function()
{
  return {
    defaultRoutePaths: '/',
    routes: {
      '/': {
        templateUrl: '/views/dashboard/dashboard.html',
        dependencies: [
          'controllers/dashboard/DashboardController'
        ]
      },
      'pennants/season': {
        templateUrl: '/views/pennants/season.html',
        dependencies: [
          'controllers/pennants/PennantsSeasonController'
        ]
      },
      '/login': {
        templateUrl: '/views/auth/login.html',
        dependencies: [
          'controllers/auth/LoginController'
        ]
      }
    }
  }
});