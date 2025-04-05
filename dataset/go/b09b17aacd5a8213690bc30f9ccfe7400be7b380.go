func concatArgs(args ...interface{}) string {
	res := fmt.Sprintln(args...)
	return res[0 : len(res)-1] // Remove newline at the end
}