func (b *boundaryReader) Next() (bool, error) {
	if b.finished {
		return false, nil
	}
	if b.partsRead > 0 {
		// Exhaust the current part to prevent errors when moving to the next part
		_, _ = io.Copy(ioutil.Discard, b)
	}
	for {
		line, err := b.r.ReadSlice('\n')
		if err != nil && err != io.EOF {
			return false, errors.WithStack(err)
		}
		if len(line) > 0 && (line[0] == '\r' || line[0] == '\n') {
			// Blank line
			continue
		}
		if b.isTerminator(line) {
			b.finished = true
			return false, nil
		}
		if err != io.EOF && b.isDelimiter(line) {
			// Start of a new part
			b.partsRead++
			return true, nil
		}
		if err == io.EOF {
			// Intentionally not wrapping with stack
			return false, io.EOF
		}
		if b.partsRead == 0 {
			// The first part didn't find the starting delimiter, burn off any preamble in front of
			// the boundary
			continue
		}
		b.finished = true
		return false, errors.Errorf("expecting boundary %q, got %q", string(b.prefix), string(line))
	}
}