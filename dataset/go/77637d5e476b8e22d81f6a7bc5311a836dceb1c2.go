func Sprintm(format string, args map[string]interface{}) string {
	f, a := gformat(format, args)
	return fmt.Sprintf(f, a...)
}