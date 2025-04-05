func checkComment(line string) bool {
	line = strings.TrimSpace(line)
	for p := range commentPrefix {
		if strings.HasPrefix(line, commentPrefix[p]) {
			return true
		}
	}
	return false
}