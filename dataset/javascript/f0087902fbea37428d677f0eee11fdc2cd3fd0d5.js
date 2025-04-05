function(defaultValue) {
                // returns the input or element value, as string
                defaultValue = defaultValue || this.options.defaultValue;
                var val = defaultValue;

                if (this.hasInput()) {
                    val = this.input.val();
                } else {
                    val = this.element.data('pickerValue');
                    val = this.options.itemProperty ? val[this.options.itemProperty] : val;
                }
                if ((val === undefined) || (val === '') || (val === null) || (val === false)) {
                    // if not defined or empty, return default
                    val = defaultValue;
                }
                return val;
            }