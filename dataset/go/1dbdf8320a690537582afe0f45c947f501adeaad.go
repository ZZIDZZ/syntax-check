func (w *Watcher) State() (state []Notification) {
	state = make([]Notification, 0)
	if w.paths == nil {
		return
	}
	for _, wi := range w.paths {
		state = append(state, *wi.Notification())
	}
	return
}