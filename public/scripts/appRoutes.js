define([], function()
{
  return {
    defaultRoutePaths: '/',
    routes: {
      '/': {
        templateUrl: '/views/dashboard/dashboard.html',
        dependencies: [
          'controllers/dashboard/DashboardController',
        ]
      },
      '/pennants/season': {
        templateUrl: '/views/pennants/season/season.html',
        dependencies: [
          'controllers/pennants/SeasonController',
          '/scripts/directives/navigationDirective.js'
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


      '/pennants/grade': {
        templateUrl: '/views/pennants/grade/grade.html',
        dependencies: [
          'controllers/pennants/GradeController',
          '/scripts/directives/seasonDirective.js'
        ]
      },
      '/pennants/grade/add': {
        templateUrl: '/views/pennants/grade/create.html',
        dependencies: [
          'controllers/pennants/GradeController'
        ]
      },
      '/pennants/grade/:gradeId/edit': {
        templateUrl: '/views/pennants/grade/edit.html',
        dependencies: [
          'controllers/pennants/GradeController'
        ]
      },

      '/pennants/games/:teamId': {
        templateUrl: '/views/pennants/game/game.html',
        dependencies: [
          'controllers/pennants/GameController'
        ]
      },

      '/pennants/game/add': {
        templateUrl: '/views/pennants/game/create.html',
        dependencies: [
          'controllers/pennants/GameController',
          '/scripts/directives/clubDirective.js',
          '/scripts/directives/positionDirective.js',
          '/scripts/directives/datePickerDirective.js'
        ]
      },


      '/pennants/draws': {
        templateUrl: '/views/pennants/draws/draws.html',
        dependencies: [
          'controllers/pennants/DrawController',
          'controllers/pennants/GameController',
          'controllers/pennants/ClubController',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js',
          '/scripts/directives/tabsDirective.js',
          '/scripts/directives/clubDirective.js'
        ]
      },

      '/pennants/game/:matchId': {
        templateUrl: 'views/pennants/match/match.html',
        dependencies: [
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js',
        ]
      },

      '/pennants/club/add': {
        templateUrl: '/views/pennants/club/create.html',
        dependecies: [
          'controllers/pennants/ClubController',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js'
        ]
      },
      '/pennants/club/:clubId': {
        templateUrl: '/views/pennants/club/list.html',
        dependecies: [
          'controllers/pennants/ClubController',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js',
          '/scripts/directives/tabsDirective.js'
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