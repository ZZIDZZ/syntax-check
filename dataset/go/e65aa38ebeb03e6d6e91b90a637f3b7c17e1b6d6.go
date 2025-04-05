func ToURL(folder string) string {
	result := folder
	for _, replace := range replaces {
		result = strings.Replace(result, replace.b, replace.a, -1)
	}
	return result
}