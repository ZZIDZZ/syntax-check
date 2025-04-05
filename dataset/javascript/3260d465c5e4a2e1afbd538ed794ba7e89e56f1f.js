function (scope) {
            if (scope.model) {
                var modelInData = false;

                for(var i = 0; i < scope.data.length; i++) {
                    if (angular.equals(scope.data[i], scope.model)) {
                        scope.model = scope.data[i];
                        modelInData = true;
                        break;
                    }
                }

                if (!modelInData) {
                    scope.model = null;
                }
            }
            if (!scope.model && !scope.chooseText && scope.data.length) {
                scope.model = scope.data[0];
            }
        }