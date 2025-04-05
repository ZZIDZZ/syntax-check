func (l *Writer) Close() error {
	l.mutex.Lock()
	defer l.mutex.Unlock()

	return l.file.Close()
}