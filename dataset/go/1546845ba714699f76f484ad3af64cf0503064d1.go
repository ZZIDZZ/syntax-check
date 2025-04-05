func ToLogLevel(level string) (LogLevel, error) {
	lowLevel := strings.ToLower(level)

	switch lowLevel {
	case "dbg":
		fallthrough
	case "debug":
		return LevelDebug, nil
	case "info":
		return LevelInfo, nil
	case "warn":
		fallthrough
	case "warning":
		return LevelWarning, nil
	case "err":
		fallthrough
	case "error":
		return LevelError, nil
	case "fatal":
		return LevelFatal, nil
	case "none":
		return LevelNone, nil
	}

	return 0, ErrUnknownLevel
}