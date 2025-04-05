func WrapHTMLF(tag string, attrs map[string]string) func(string) string {
	return func(s string) string {
		return WrapHTML(s, tag, attrs)
	}
}