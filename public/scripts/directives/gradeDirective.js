pennantsApp.directive('gradeDisplay', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'A',
    template: '<h4>Grade: <% grade.name %></h4>',
    link: function($scope, element, attrs) {
      var gradeId = $cookies.pennantsGrade;

      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/grade/'+gradeId);

      if(!cacheData) {
        $http.get('/api/v1/pennants/grade/'+gradeId).success(function(grade) {
          $scope.grade = grade;
          cache.put('/api/v1/pennants/grade/'+gradeId, grade);
        });
      } else {
        $scope.grade = cacheData;
      }
    }
  }
});

pennantsApp.directive('gradeText', function($cookies, $http, $cacheFactory) {
  return {
    restrict: 'AE',
    scope: {
      id: '@',
      grade_id: '@'
    },
    template: '<% grade %>',
    link: function(scope, elem, attr) {
      var cache = $cacheFactory.get('$http');

      var cacheData = cache.get('/api/v1/pennants/grade/'+attr.gradeId);

      cache.remove('/api/v1/pennants/grade/'+attr.gradeId);

      if(!cacheData) {
        $http.get('/api/v1/pennants/grade/'+attr.gradeId).success(function(grade) {
          scope.grade = grade.name;
          cache.put('/api/v1/pennants/grade/'+attr.gradeId, grade.name);
        });
      } else {
        scope.grade = cacheData;
      }
    }
  }
});

pennantsApp.directive('gradeSettingsPlayers', function ($parse) {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
      scope.$watch('grade.settings_players', function(val) {
        scope.maxPlayers = _.range(1, (_.isEmpty(val)) ? 0 : parseInt(val) + 1);
      });
    }
  }
});

pennantsApp.directive('handicappedPlayers', function() {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
      scope.$watch('grade.settings_not_handicapped', function(val) {
        scope.limitPlayers = parseInt(val);
      });
    }
  }
});

pennantsApp.directive('checklistModel', ['$parse', '$compile', function($parse, $compile) {
  // contains
  function contains(arr, item) {
    if (angular.isArray(arr)) {
      for (var i = 0; i < arr.length; i++) {
        if (angular.equals(arr[i], item)) {
          return true;
        }
      }
    }
    return false;
  }

  // add
  function add(arr, item) {
    arr = angular.isArray(arr) ? arr : [];
    for (var i = 0; i < arr.length; i++) {
      if (angular.equals(arr[i], item)) {
        return arr;
      }
    }
    arr.push(item);
    return arr;
  }

  // remove
  function remove(arr, item) {
    if (angular.isArray(arr)) {
      for (var i = 0; i < arr.length; i++) {
        if (angular.equals(arr[i], item)) {
          arr.splice(i, 1);
          break;
        }
      }
    }
    return arr;
  }

  // http://stackoverflow.com/a/19228302/1458162
  function postLinkFn(scope, elem, attrs) {
    // compile with `ng-model` pointing to `checked`
    $compile(elem)(scope);

    // getter / setter for original model
    var getter = $parse(attrs.checklistModel);
    var setter = getter.assign;

    // value added to list
    var value = $parse(attrs.checklistValue)(scope.$parent);

    // watch UI checked change
    scope.$watch('checked', function(newValue, oldValue) {
      if (newValue === oldValue) {
        return;
      }
      var current = getter(scope.$parent);
      if (newValue === true) {
        setter(scope.$parent, add(current, value));
      } else {
        setter(scope.$parent, remove(current, value));
      }

      if(_.isArray(current)) {
        if(current.length >= scope.limitPlayers) {
          $('.not-handicapped').not(':checked').each(function(){
            $(this).attr('disabled','disabled');
          });
        } else {
          $('.not-handicapped').attr('disabled',false);
        }
      } else {
        if(value >= scope.limitPlayers) {
          $('.not-handicapped').not(':checked').each(function(){
            $(this).attr('disabled','disabled');
          });
        } else {
          $('.not-handicapped').attr('disabled',false);
        }
      }
    });

    // watch original model change
    scope.$parent.$watch(attrs.checklistModel, function(newArr, oldArr) {
      scope.checked = contains(newArr, value);
    }, true);
  }

  return {
    restrict: 'A',
    priority: 1000,
    terminal: true,
    scope: true,
    compile: function(tElement, tAttrs) {
      if (tElement[0].tagName !== 'INPUT' || !tElement.attr('type', 'checkbox')) {
        throw 'checklist-model should be applied to `input[type="checkbox"]`.';
      }

      if (!tAttrs.checklistValue) {
        throw 'You should provide `checklist-value`.';
      }

      // exclude recursion
      tElement.removeAttr('checklist-model');

      // local scope var storing individual checkbox model
      tElement.attr('ng-model', 'checked');

      return postLinkFn;
    }
  };
}]);