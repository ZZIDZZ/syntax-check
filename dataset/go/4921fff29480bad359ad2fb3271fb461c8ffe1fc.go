func (p *Pool) GetSize() int {
	p.workerMut.Lock()
	defer p.workerMut.Unlock()

	return len(p.workers)
}