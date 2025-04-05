func findFakeFunctionFor(fako string) func() string {
	result := func() string { return "" }

	for kind, function := range allGenerators() {
		if fako == kind {
			result = function
			break
		}
	}

	return result
}