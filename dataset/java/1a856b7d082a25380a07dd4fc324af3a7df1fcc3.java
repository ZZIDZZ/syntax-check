public void createDatabase(String databaseName) throws TException {
    HiveMetaStoreClient client = new HiveMetaStoreClient(conf());
    String databaseFolder = new File(temporaryFolder.getRoot(), databaseName).toURI().toString();
    try {
      client.createDatabase(new Database(databaseName, null, databaseFolder, null));
    } finally {
      client.close();
    }
  }