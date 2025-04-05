function isIdent(c) {
	return c === COLON || c === DASH || isAlpha(c) || isNumber(c);
}