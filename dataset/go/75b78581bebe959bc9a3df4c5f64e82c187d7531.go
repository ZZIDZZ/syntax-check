func (b *PointerRingBuf) TwoContig() (first []interface{}, second []interface{}) {

	extent := b.Beg + b.Readable
	if extent <= b.N {
		// we fit contiguously in this buffer without wrapping to the other.
		// Let second stay an empty slice.
		return b.A[b.Beg:(b.Beg + b.Readable)], second
	}

	return b.A[b.Beg:b.N], b.A[0:(extent % b.N)]
}