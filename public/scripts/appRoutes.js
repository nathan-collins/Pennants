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
      '/pennants/season': {
        templateUrl: '/views/pennants/season/season.html',
        dependencies: [
          'controllers/pennants/SeasonController'
        ]
      },
      '/pennants/season/add': {
        templateUrl: '/views/pennants/season/create.html',
        dependencies: [
          'controllers/pennants/SeasonController'
        ]
      },
      '/pennants/season/:seasonId/edit': {
        templateUrl: '/views/pennants/season/edit.html',
        dependencies: [
          'controllers/pennants/SeasonController'
        ]
      },
      'pennants/grades/:seasonId': {
        templateUrl: '/views/pennants/grade/edit.html',
        dependencies: [
          'controllers/pennants/GradeController'
        ]
      },
      '/login': {
        templateUrl: '/views/auth/login.html',
        dependencies: [
          'controllers/auth/LoginController',
          'services/authenticationService',
          'services/flashService',
          'services/sessionService'
        ]
      }
    }
  }
});