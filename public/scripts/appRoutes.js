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

      /* Players Area */
      '/pennants/player': {
        templateUrl: '/views/pennants/player/player.html',
        dependencies: [
          'controllers/pennants/PlayerController'
        ]
      },
      '/pennants/player/add': {
        templateUrl: '/views/pennants/player/add.html',
        dependencies: [
          'controllers/pennants/PlayerController'
        ]
      },
      '/pennants/player/add/:clubId': {
        templateUrl: '/views/pennants/player/add.html',
        dependencies: [
          'controllers/pennants/PlayerController'
        ]
      },


      /* Games Area */
      '/pennants/game/add': {
        templateUrl: '/views/pennants/game/create.html',
        dependencies: [
          'controllers/pennants/GameController',
          '/scripts/directives/clubDirective.js',
          '/scripts/directives/positionDirective.js',
          '/scripts/directives/bootstrap/datePickerDirective.js'
        ]
      },
      '/pennants/game/:teamId': {
        templateUrl: '/views/pennants/game/game.html',
        dependencies: [
          'controllers/pennants/GameController'
        ]
      },
      '/pennants/game/:matchId': {
        templateUrl: 'views/pennants/match/match.html',
        dependencies: [
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js',
        ]
      },

      /* Draws Area */
      '/pennants/draws': {
        templateUrl: '/views/pennants/draws/draws.html',
        dependencies: [
          'controllers/pennants/DrawController',
          'controllers/pennants/GameController',
          'controllers/pennants/ClubController',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js',
          '/scripts/directives/bootstrap/tabsDirective.js',
          '/scripts/directives/clubDirective.js'
        ]
      },

      /* Club Area */
      '/pennants/club/add': {
        templateUrl: '/views/pennants/club/create.html',
        dependecies: [
          'controllers/pennants/ClubController',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js'
        ]
      },
      '/pennants/club/add/:clubId': {
        templateUrl: '/views/pennants/club/container.html',
        dependecies: [
          'controllers/pennants/ClubController',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js'
        ]
      },
      '/pennants/club/:clubId': {
        templateUrl: '/views/pennants/club/container.html',
        dependecies: [
          'controllers/pennants/ClubController',
          '/scripts/directives/seasonDirective.js',
          '/scripts/directives/gradeDirective.js',
          '/scripts/directives/bootstrap/tabsDirective.js'
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