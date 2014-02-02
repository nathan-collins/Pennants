define(['appModule'], function(app) {
  app.lazy.directive('navSidebar',
    function($cookies, $http) {
      function link( $scope, element, attributes )
      {
        var expression = attributes.navSidebar;

        var duration = ( attributes.navShowDuration || "fast");

        if( !$scope.$eval(expression)) {
          element.hide();
        }

        $scope.$watch(
          expression,
          function( newValue, oldValue) {
            if ( newValue === oldValue ) {
              return;
            }

            if ( newValue ) {
              element.stop( true, true ).slideDown( duration );
              // Hide element.
            } else {
              element.stop( true, true ).slideUp( duration );
            }
          }
        )
      };

      return {
        restrict: 'A',
        link: link
      }
    }
  );

  app.lazy.directive('rightNavigation',
    function() {
      return {
        restrict: 'A',
        templateUrl: '/views/pennants/layouts/right-navigation.html',
        link: function ($scope, $element, $attributes) {
          $scope.forEach($scope.rightNavigation, function(links, key) {
            $scope.links = links;
            $scope.titles = key;
          });
        }
      }
    }
  );
});