func KeyLen(x uint64) int {
	n := 1
	if x >= 1<<32 {
		x >>= 32
		n += 4
	}
	if x >= 1<<16 {
		x >>= 16
		n += 2
	}
	if x >= 1<<8 {
		x >>= 8
		n += 1
	}
	return n
}