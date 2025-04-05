func Execute(ctx context.Context, args ...interface{}) ExitStatus {
	return DefaultCommander.Execute(ctx, args...)
}