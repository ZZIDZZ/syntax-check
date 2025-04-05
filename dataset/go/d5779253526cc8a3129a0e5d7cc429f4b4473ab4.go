func (s *OffsetStash) Offsets() map[string]int64 {
	s.mu.Lock()
	defer s.mu.Unlock()

	res := make(map[string]int64, len(s.offsets))
	for tp, info := range s.offsets {
		res[tp.String()] = info.Offset
	}
	return res
}