func MDTemplateEngine(input string, data map[string]interface{}, helpers map[string]interface{}) (string, error) {
	if ct, ok := data["contentType"].(string); ok && ct == "text/plain" {
		return plush.BuffaloRenderer(input, data, helpers)
	}
	source := github_flavored_markdown.Markdown([]byte(input))
	source = []byte(html.UnescapeString(string(source)))
	return plush.BuffaloRenderer(string(source), data, helpers)
}