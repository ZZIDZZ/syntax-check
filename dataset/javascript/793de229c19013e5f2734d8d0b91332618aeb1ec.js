function getFilterString(selectedValues) {
	if (selectedValues && Object.keys(selectedValues).length) {
		return Object
			// take all selectedValues
			.entries(selectedValues)
			// filter out filter components having some value
			.filter(([, componentValues]) =>
				filterComponents.includes(componentValues.componentType)
					// in case of an array filter out empty array values as well
					&& (
						(componentValues.value && componentValues.value.length)
						// also consider range values in the shape { start, end }
						|| componentValues.value.start || componentValues.value.end
					))
			// parse each filter value
			.map(([componentId, componentValues]) => parseFilterValue(componentId, componentValues))
			// return as a string separated with comma
			.join();
	}
	return null;
}