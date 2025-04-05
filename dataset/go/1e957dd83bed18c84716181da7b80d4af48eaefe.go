func NewStreamHandler(w io.Writer) (*StreamHandler, error) {
	h := new(StreamHandler)

	h.w = w

	return h, nil
}