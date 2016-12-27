app.directive("cpfMask", function() {
   var template = "000.000.000-00";
  return {
    link : function(scope, element, attrs) {
        var options = {
            onKeyPress: function(val, e, field, options) {
                putMask();
            }
        }

        $(element).mask(template, options);

        function putMask() {
            var mask;
            var cleanVal = element[0].value.replace(/\D/g, '');//pega o valor sem mascara
            if(cleanVal.length > 10) {//verifica a quantidade de digitos.
                mask = template;
            } else {
                mask = template;
            }
            $(element).mask(mask, options);//aplica a mascara novamente
        }
    }
  }
})

.directive('cpfValidator', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function (scope, element, attr, ctrl) {

            function customValidator(ngModelValue) {
                function getFirstDigit(v) {
                    var matriz = [10, 9, 8, 7, 6, 5, 4, 3, 2];
                    var total = 0,
                        verifc;
                    for (var i = 0; i < 9; i++) {
                        total += v[i] * matriz[i];
                    }
                    verifc = ((total % 11) < 2) ? 0 : (11 - (total % 11));
                    return verifc;
                }

                function getSecondDigit(v) {
                    var matriz = [11, 10, 9, 8, 7, 6, 5, 4, 3, 2];
                    var total = 0,
                        verifc;
                    for (var i = 0; i < 10; i++) {
                        total += v[i] * matriz[i];
                    }
                    verifc = ((total % 11) < 2) ? 0 : (11 - (total % 11));
                    return verifc;
                }

                if (ngModelValue.length >= 11) {
                    ctrl.$setValidity('cpfIncomplet', true);
                    var digits = ngModelValue.replace(/\D+/g, '');
                    var dig1 = getFirstDigit(digits.substr(0, 9));
                    var dig2 = getSecondDigit(digits.substr(0, 10));
                    var final = digits.substr(9,2);
                    var val = ""+dig1+dig2;
                    if (final === val) {
                        ctrl.$setValidity('cpfInvalid', true);
                    }
                    else
                    {
                        ctrl.$setValidity('cpfInvalid', false);
                    }
                } else {
                    ctrl.$setValidity('cpfIncomplet', false);
                }
                return ngModelValue;
            }
            ctrl.$parsers.push(customValidator);
        }
    };
})


.directive('onlyLetters', function () {
     return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
           if (inputValue == undefined) return ''
           var transformedInput = inputValue.replace(/[^[a-zA-Z ]/g, '');
           if (transformedInput!=inputValue) {
              modelCtrl.$setViewValue(transformedInput);
              modelCtrl.$render();
           }

           return transformedInput;
       });
     }
   };
})

.directive('uppercase', function() {
    return {
      require: 'ngModel',
      link: function(scope, element, attrs, modelCtrl) {
        var capitalize = function(inputValue) {
          if (inputValue == undefined) inputValue = '';
          var capitalized = inputValue.toUpperCase();
          if (capitalized !== inputValue) {
            modelCtrl.$setViewValue(capitalized);
            modelCtrl.$render();
          }
          return capitalized;
        }
        modelCtrl.$parsers.push(capitalize);
        capitalize(scope[attrs.ngModel]); // capitalize initial value
      }
    };
  })

.directive('datepicker', function() {
  return {
    link: function(scope, el, attr) {
      $(el).datepicker({
        changeMonth: true,
        changeYear: true,
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        dateFormat: 'dd/mm/yy',
        minDate: '01/01/1916',
        nextText: 'Próximo',
        prevText: 'Anterior',
        onSelect: function(dateText) {
          console.log(dateText);
        }
      });
    }
  };
})

.directive('datepickerYear', function() {
  return {
    link: function(scope, el, attr) {
      $(el).datepicker({
        changeMonth: false,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        closeText: 'Fechar',
        onClose: function(dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
      });
    }
  };
})

.directive("celMask", function() {
   var template = "(00) 00000-0000";
  return {
    link : function(scope, element, attrs) {
        var options = {
            onKeyPress: function(val, e, field, options) {
                putMask();
            }
        }
        $(element).mask(template, options);

        function putMask() {
            var mask;
            var cleanVal = element[0].value.replace(/\D/g, '');//pega o valor sem mascara
            if(cleanVal.length > 10) {//verifica a quantidade de digitos.
                mask = template;
            } else {
                mask = template;
            }
            $(element).mask(mask, options);//aplica a mascara novamente
        }
    }
  }
})

.directive("telMask", function() {
   var template = "(00) 0000-0000";
  return {
    link : function(scope, element, attrs) {
        var options = {
            onKeyPress: function(val, e, field, options) {
                putMask();
            }
        }
        $(element).mask(template, options);

        function putMask() {
            var mask;
            var cleanVal = element[0].value.replace(/\D/g, '');//pega o valor sem mascara
            if(cleanVal.length > 10) {//verifica a quantidade de digitos.
                mask = template;
            } else {
                mask = template;
            }
            $(element).mask(mask, options);//aplica a mascara novamente
        }
    }
  }
})

 .directive('date', function (dateFilter) {
        return {
            require:'ngModel',
            link:function (scope, elm, attrs, ctrl) {
                var dateFormat = attrs['date'] || 'yyyy-MM-dd';
                ctrl.$formatters.unshift(function (modelValue) {
                    return dateFilter(modelValue, dateFormat);
                });
            }
        };
    })

.directive('formatCurrency', ['$filter', function ($filter) {
    return {
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;
            ctrl.$formatters.unshift(function (a) {
                return $filter(attrs.format)(ctrl.$modelValue)
            });
            ctrl.$parsers.unshift(function (viewValue) {
                  elem.priceFormat({
                      prefix: '',
                      centsSeparator: ',',
                      thousandsSeparator: '.'
                  });
                    return elem[0].value;
            });
        }
    };
}]);










