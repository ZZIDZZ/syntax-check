static public MarkLogicDatasetGraph createDatasetGraph(String host,
            int port, String user, String password, Authentication type) {
        DatabaseClient client = DatabaseClientFactory.newClient(host, port,
                user, password, type);
        return MarkLogicDatasetGraphFactory.createDatasetGraph(client);
    }