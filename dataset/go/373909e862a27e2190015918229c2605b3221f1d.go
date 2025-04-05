func (w *WaitGroup) Wait() {
	if w.outstanding == 0 {
		return
	}
	for w.outstanding > 0 {
		select {
		case <-w.completed:
			w.outstanding--
		}
	}
}