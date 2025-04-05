func SliceContainsString(a string, list []string) bool {
	for _, b := range list {
		if strings.Contains(b, a) {
			return true
		}
	}
	return false
}