public QueryBuilder subquery(final String lhsPredicate) {
		final WhereSubquery subquery = new WhereSubquery(builder(),
				lhsPredicate);
		items.add(subquery);
		return subquery.getQueryBuilder();
	}