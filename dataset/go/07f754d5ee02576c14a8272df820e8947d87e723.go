func parseFuncName(fnName string) (packagePath, signature string) {
	regEx := regexp.MustCompile("([^\\(]*)\\.(.*)")
	parts := regEx.FindStringSubmatch(fnName)
	packagePath = parts[1]
	signature = parts[2]
	return
}