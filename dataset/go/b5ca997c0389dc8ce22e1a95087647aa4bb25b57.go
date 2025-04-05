func WriteImageToHTTP(w http.ResponseWriter, img image.Image) error {
	buffer := new(bytes.Buffer)
	if err := png.Encode(buffer, img); err != nil {
		return err
	}

	w.Header().Set("Content-Type", "image/png")
	w.Header().Set("Content-Length", strconv.Itoa(len(buffer.Bytes())))
	if _, err := w.Write(buffer.Bytes()); err != nil {
		return err
	}
	return nil
}