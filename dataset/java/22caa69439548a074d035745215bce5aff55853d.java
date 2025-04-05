public long update(T obj) {
		ContentValues cv = th.getEditableValues(obj);
		Long id = th.getId(obj);
		int numRowsUpdated = getWritableDb().update(th.getTableName(), cv, th.getIdCol()
				+ "=?", new String[] { id.toString() });
		return numRowsUpdated;
	}