func (s *FileSequence) Copy() *FileSequence {
	seq, _ := NewFileSequence(s.String())
	return seq
}