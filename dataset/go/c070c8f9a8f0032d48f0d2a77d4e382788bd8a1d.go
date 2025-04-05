func (f *File) Readdir(n int) ([]os.FileInfo, error) {
	if f.result != nil && !f.result.IsTruncated {
		return make([]os.FileInfo, 0), io.EOF
	}

	reader, err := f.sendRequest(n)
	if err != nil {
		return nil, err
	}
	defer reader.Close()

	return f.parseResponse(reader)
}