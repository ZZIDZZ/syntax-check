func NullNotification(title, message string) GNotifier {
	config := &Config{title, message, 5000, ""}
	n := &nullNotifier{Config: config}
	return n
}