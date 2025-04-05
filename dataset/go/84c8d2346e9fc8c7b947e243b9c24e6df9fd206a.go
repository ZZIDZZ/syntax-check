func (l *slog) SetLevel(level Level) {
	atomic.StoreUint32((*uint32)(&l.lvl), uint32(level))
}