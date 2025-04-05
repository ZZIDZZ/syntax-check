func Split(s string, posix bool) ([]string, error) {
	return NewLexerString(s, posix, true).Split()
}