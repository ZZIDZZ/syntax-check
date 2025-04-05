func (p *Pipeline) Result() Result {
	action := p.actions[len(p.actions)-1]
	action.rMutex.Lock()
	defer action.rMutex.Unlock()
	return action.result
}