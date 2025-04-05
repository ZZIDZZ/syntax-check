function () {

          if (attrs.type === 'radio') {
            // when the switch is clicked
            element.on('change.bootstrapSwitch', function (e) {
              // discard not real change events
              if ((controller.$modelValue === controller.$viewValue) && (e.target.checked !== $(e.target).bootstrapSwitch('state'))) {
                // $setViewValue --> $viewValue --> $parsers --> $modelValue
                // if the switch is indeed selected
                if (e.target.checked) {
                  // set its value into the view
                  controller.$setViewValue(getTrueValue());
                } else if (getTrueValue() === controller.$viewValue) {
                  // otherwise if it's been deselected, delete the view value
                  controller.$setViewValue(undefined);
                }
                switchChange();
              }
            });
          } else {
            // When the checkbox switch is clicked, set its value into the ngModel
            element.on('switchChange.bootstrapSwitch', function (e) {
              // $setViewValue --> $viewValue --> $parsers --> $modelValue
              controller.$setViewValue(e.target.checked);
              switchChange();
            });
          }
        }