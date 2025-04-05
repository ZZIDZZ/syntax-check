private static Path copy(String resource, String directory) throws IOException {
        mkdir(directory);
        String fileName = resource.substring(resource.lastIndexOf("/") + 1);
        InputStream from = EmbeddedCassandraServerHelper.class.getResourceAsStream(resource);
        Path copyName = Paths.get(directory, fileName);
        Files.copy(from, copyName);
        return copyName;
    }