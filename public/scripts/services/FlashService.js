define([], function() {
  return function(dependencies)
  {
    var FlashService = function($rootScope) {
      return {
        show: function(message) {
          $rootScope.flash = message;
        },
        clear: function() {
          $rootScope.flash = "";
        }
      }
    };
  }
})