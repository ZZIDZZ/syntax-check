public Set<String> getIntersectingIds(
			double minLongitude, double minLatitude, double maxLongitude, double maxLatitude)
	{
		Set<String> ids = new HashSet<>();
		forCellsIn(minLongitude, minLatitude, maxLongitude, maxLatitude, cell ->
		{
			ids.addAll(cell.getAllIds());
		});
		return ids;
	}