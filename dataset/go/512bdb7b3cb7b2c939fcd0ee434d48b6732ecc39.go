func (gs *gossipSenders) Flush() bool {
	sent := false
	gs.Lock()
	defer gs.Unlock()
	for _, sender := range gs.senders {
		sent = sender.Flush() || sent
	}
	return sent
}