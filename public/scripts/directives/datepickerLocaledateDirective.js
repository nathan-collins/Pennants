app.directive('datepickerLocaldate', ['$parse', function ($parse) {
  var directive = {
    restrict: 'A',
    require: ['ngModel'],
    link: link
  };
  return directive;

  function link(scope, element, attr, ctrls) {
    var ngModelController = ctrls[0];

    // called with a JavaScript Date object when picked from the datepicker
    ngModelController.$parsers.push(function(viewValue) {
      return viewValue.getFullYear() + '-' + (viewValue.getMonth() + 1) + '-' + viewValue.getDate();
    });

    // called with a 'yyyy-mm-dd' string to format
    ngModelController.$formatters.push(function(modelValue) {
      if(!modelValue) {
        return undefined;
      }
      return new Date(modelValue);
    });
  }
}]);