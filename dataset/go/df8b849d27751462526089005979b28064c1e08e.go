func (pool *Pool) Status() stats {
	stats_pipe := make(chan stats)
	if pool.supervisor_started {
		pool.stats_wanted_pipe <- stats_pipe
		return <-stats_pipe
	}
	// the supervisor wasn't started so we return a zeroed structure
	return stats{}
}