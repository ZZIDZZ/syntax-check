func Right(str string, length int, pad string) string {
	return str + times(pad, length-len(str))
}