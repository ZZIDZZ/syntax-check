func toPattern(verb, path string) *gen.PathPattern {
	pattern := gen.PathPattern{
		HTTPMethod: verb,
		Path:       path,
		Pattern:    pathVariablesRegexp.ReplaceAllLiteralString(path, "/%s"),
		Regexp: pathVariablesRegexp.ReplaceAllLiteralString(regexp.QuoteMeta(path),
			`/([^/]+)`),
	}
	matches := pathVariablesRegexp.FindAllStringSubmatch(path, -1)
	if len(matches) > 0 {
		pattern.Variables = make([]string, len(matches))
		for i, m := range matches {
			pattern.Variables[i] = m[1]
		}
	}
	return &pattern
}