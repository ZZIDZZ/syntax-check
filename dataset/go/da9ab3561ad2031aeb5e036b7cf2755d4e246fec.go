func (ref dirReference) signaturePath(index int) string {
	return filepath.Join(ref.path, fmt.Sprintf("signature-%d", index+1))
}