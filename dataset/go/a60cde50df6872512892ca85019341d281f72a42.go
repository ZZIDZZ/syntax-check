func WithDialPeerTimeout(ctx context.Context, timeout time.Duration) context.Context {
	return context.WithValue(ctx, dialPeerTimeoutCtxKey{}, timeout)
}