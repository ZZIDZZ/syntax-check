protected final void checkDatasource() {
      // Check database connection information of data source
      if (dataSource != null) {
         //noinspection unused,EmptyTryBlock
         try (Connection connection = dataSource.getConnection()) {
            // Just get the connection to check if data source parameters are configured correctly.
         } catch (SQLException e) {
            dataSource = null;
            logger.error("Failed to connect to database of data source: {}.", e.getMessage());
            if (!ignore) {
               throw new IllegalArgumentException("Failed to connect to the database.", e);
            }
         }
      }
   }