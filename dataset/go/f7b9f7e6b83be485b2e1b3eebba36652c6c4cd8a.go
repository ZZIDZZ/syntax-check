func NewLinear(start time.Duration, limit time.Duration) *Backoff {
	return NewBackoff(linear{}, start, limit)
}