func (r *Raft) compactLogs(snapIdx uint64) error {
	defer metrics.MeasureSince([]string{"raft", "compactLogs"}, time.Now())
	// Determine log ranges to compact
	minLog, err := r.logs.FirstIndex()
	if err != nil {
		return fmt.Errorf("failed to get first log index: %v", err)
	}

	// Check if we have enough logs to truncate
	lastLogIdx, _ := r.getLastLog()
	if lastLogIdx <= r.conf.TrailingLogs {
		return nil
	}

	// Truncate up to the end of the snapshot, or `TrailingLogs`
	// back from the head, which ever is further back. This ensures
	// at least `TrailingLogs` entries, but does not allow logs
	// after the snapshot to be removed.
	maxLog := min(snapIdx, lastLogIdx-r.conf.TrailingLogs)

	// Log this
	r.logger.Info(fmt.Sprintf("Compacting logs from %d to %d", minLog, maxLog))

	// Compact the logs
	if err := r.logs.DeleteRange(minLog, maxLog); err != nil {
		return fmt.Errorf("log compaction failed: %v", err)
	}
	return nil
}