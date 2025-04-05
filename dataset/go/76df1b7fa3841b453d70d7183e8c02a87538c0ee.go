func (c *Candidate) IsLeader() bool {
	c.lock.Lock()
	defer c.lock.Unlock()
	return c.leader
}