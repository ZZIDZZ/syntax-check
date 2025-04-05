func (r *Range) CheckUint64(val uint64) bool {
	return r.Check(float64(val))
}