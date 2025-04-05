func CreateFile(filename string, size int64) error {

	buf := make([]byte, size)

	// Create the file store some data
	fp, err := os.Create(filename)
	if err != nil {
		return err
	}

	// Write the buffer
	_, err = fp.Write(buf)

	// Cleanup
	fp.Close()

	return err
}