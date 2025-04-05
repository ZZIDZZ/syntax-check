public String queryInWithSql(String database, String sql) {
		JdbcTemplate template = getDatabaseJdbcTemplate(database);
		if (sql != null && !sql.trim().toUpperCase().startsWith(JdbcFixture.SELECT_COMMAND_PREFIX)) {
			return Objects.toString(template.update(sql));
		}
		List<String> results = template.queryForList(sql, String.class);
		if(results == null || results.isEmpty()) {
			return null;
		}
		return results.get(0);
	}