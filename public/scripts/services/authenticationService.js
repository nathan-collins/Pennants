define(['services/flashService', 'services/sessionService', 'global'], function(FlashService, SessionService, global)
{
  return function($httpProvider, $sanitize) {
    var cacheSession   = function() {
      SessionService.set('authenticated', true);
    };

    var uncacheSession = function() {
      SessionService.unset('authenticated');
    };

    var loginError = function(response) {
      FlashService.show(response.flash);
    };

    var sanitizeCredentials = function(credentials)
    {
      return {
        username:  	$sanitize(credentials.username),
        password: 	$sanitize(credentials.password),
        csrf_token: global.CSRF_TOKEN
      };
    };

    var logsOutUserOn401 = function($location, $q) {
      var success = function(response) {
        return response;
      };

      var error = function(response) {
        if(response.status === 401) {
          SessionService.unset('authenticated');
          $location.path('/login');
          FlashService.show(response.data.flash);
        }
        return $q.reject(response);
      };

      return function(promise) {
        return promise.then(success, error);
      };
    };

    return {
      login: function(credentials)
      {
        var login = $httpProvider.post("/auth/login", sanitizeCredentials(credentials));
        login.success(cacheSession);
        login.success(FlashService.clear);
        login.error(loginError);
        return login;
      },
      logout: function() {
        var logout = $httpProvider.get("/auth/logout");
        logout.success(uncacheSession);
        return logout;
      },
      isLoggedIn: function() {
        return SessionService.get('authenticated');
      },
      validate: function() {
        $httpProvider.responseInterceptors.push(logsOutUserOn401);
      }
    };
  }
})