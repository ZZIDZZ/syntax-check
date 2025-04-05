private <T extends MeasureAppender> List<T> executeQuery(final SqlQueryBuilder<T> sqlQueryBuilder) throws NovieRuntimeException {
        sqlQueryBuilder.buildQuery();
        final String queryString = sqlQueryBuilder.getQueryString();
        LOG.debug(queryString);

        long beforeQuery = System.currentTimeMillis();
        List<T> returnValue = jdbcTemplate.query(queryString, sqlQueryBuilder.getMapSqlParameterSource(), sqlQueryBuilder);

        if (LOG.isInfoEnabled()) {
            LOG.info("SQL query successfully ran in " + (System.currentTimeMillis() - beforeQuery) + "ms.");
        }

        if (LOG.isDebugEnabled()) {
            StringBuilder sb = new StringBuilder();
            for (Entry<String, Object> e : sqlQueryBuilder.getMapSqlParameterSource().getValues().entrySet()) {
                if (sb.length() > 0) {
                    sb.append(",");
                }
                sb.append(e.getKey());
                sb.append("=");
                sb.append(e.getValue());

            }
            sb.insert(0, "Parameters [");
            sb.append("]");
            LOG.debug(sb.toString());
        }
        return returnValue;
    }