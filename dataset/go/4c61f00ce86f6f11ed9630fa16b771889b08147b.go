func (a *Archive) ExtractToFile(dstPath string, name string) error {
	f, err := os.Create(dstPath)
	if err != nil {
		return err
	}
	defer f.Close()
	return a.ExtractToWriter(f, name)
}