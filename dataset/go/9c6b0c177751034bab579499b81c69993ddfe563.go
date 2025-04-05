func New(file *os.File) Archive {
	if filepath.Ext(file.Name()) == ".zip" {
		return zip.New(file)
	}
	return tar.New(file)
}