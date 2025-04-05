func SaveConfigFile(c *ConfigFile, filename string) (err error) {
	// Write configuration file by filename.
	var f *os.File
	if f, err = os.Create(filename); err != nil {
		return err
	}

	if err := SaveConfigData(c, f); err != nil {
		return err
	}
	return f.Close()
}