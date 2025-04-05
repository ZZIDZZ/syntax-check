public Counts getCounts() {
		Counts counts = new Counts();
		for (FileCount fileCount : results) {
			counts.tally(fileCount.getCounts());
		}
		return counts;
	}