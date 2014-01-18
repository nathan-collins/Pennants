require.config({
  baseUrl: '/scripts',
  paths: {
  }
});

require
(
  [
    // Load the appModule file
    'appModule'
  ],
  function(app)
  {
    angular.bootstrap(document, ['app']);
  }
);