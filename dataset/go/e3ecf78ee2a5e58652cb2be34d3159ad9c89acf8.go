func (k *Kace) KebabUpper(s string) string {
	return delimitedCase(s, kebabDelim, true)
}