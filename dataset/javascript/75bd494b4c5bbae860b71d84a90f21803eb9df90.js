function(selectedDates, dateStr, instance) {
					that.setProperty("dateValue", selectedDates, true);
					that.fireOnChange({selectedDates: selectedDates, dateStr: dateStr, instance: instance});
				}