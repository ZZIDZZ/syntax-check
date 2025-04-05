func newBuffer(r io.Reader, offset int64) *buffer {
	return &buffer{
		r:           r,
		offset:      offset,
		buf:         make([]byte, 0, 4096),
		allowObjptr: true,
		allowStream: true,
	}
}