func getAndClearWrittenDirs() []string {
	dirSetMutex.Lock()
	defer dirSetMutex.Unlock()
	dirs := make([]string, 0, len(dirSet))
	for d := range dirSet {
		dirs = append(dirs, d)
	}
	dirSet = make(map[string]bool)
	return dirs
}