func (s *MockSpan) SetOperationName(operationName string) opentracing.Span {
	s.Lock()
	defer s.Unlock()
	s.OperationName = operationName
	return s
}