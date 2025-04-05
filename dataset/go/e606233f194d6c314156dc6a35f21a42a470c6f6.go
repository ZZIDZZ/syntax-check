func unlinkGRs() {
	childID := curGoroutineID()
	dataLock.Lock()
	delete(data, childID)
	dataLock.Unlock()
}