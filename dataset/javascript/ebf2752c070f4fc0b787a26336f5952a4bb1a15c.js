function () {
            var $this = this;

            // re-set the slider step if specified
            var lastStepHistogram = $this.data('last_step_histogram');
            if (typeof lastStepHistogram !== 'undefined') {
                methods.set_step_histogram.call($this, lastStepHistogram); 
            }

            // re-center given values
            _methods.set_position_from_val.call($this, 
                methods.get_current_min_value.call($this),
                methods.get_current_max_value.call($this)
            );

            // re-highlight the range
            var highlightRangeMin = $this.data('highlightedRangeMin');
            if (typeof highlightRangeMin === 'number') {
                // a highlight range is present, we must update it
                var highlightRangeMax = $this.data('highlightedRangeMax');
                methods.highlight_range.call($this, highlightRangeMin, highlightRangeMax);
            }

            _methods.notify_changed_implicit.call($this, 'refresh');
            return $this;
        }