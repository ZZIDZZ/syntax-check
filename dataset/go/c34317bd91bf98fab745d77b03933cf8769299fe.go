func Split(s string) ([]string, error) {
	l := NewLexer(strings.NewReader(s))
	subStrings := make([]string, 0)
	for {
		word, err := l.Next()
		if err != nil {
			if err == io.EOF {
				return subStrings, nil
			}
			return subStrings, err
		}
		subStrings = append(subStrings, word)
	}
}