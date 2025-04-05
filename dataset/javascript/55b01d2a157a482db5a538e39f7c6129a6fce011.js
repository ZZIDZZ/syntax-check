function isUnquoted(code) {
	return !isNaN(code) && !isQuote(code) && !isSpace(code) && !isTerminator(code);
}