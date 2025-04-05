func (w contextWriter) WriteHeader(code int) {
	w.context.written = true
	w.ResponseWriter.WriteHeader(code)
}