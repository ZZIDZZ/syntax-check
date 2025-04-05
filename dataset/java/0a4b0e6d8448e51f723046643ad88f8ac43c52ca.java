protected void writeCoveralls(final JsonWriter writer, final SourceCallback sourceCallback, final List<CoverageParser> parsers) throws ProcessingException, IOException {
        try {
            getLog().info("Writing Coveralls data to " + writer.getCoverallsFile().getAbsolutePath() + "...");
            long now = System.currentTimeMillis();
            sourceCallback.onBegin();
            for (CoverageParser parser : parsers) {
                getLog().info("Processing coverage report from " + parser.getCoverageFile().getAbsolutePath());
                parser.parse(sourceCallback);
            }
            sourceCallback.onComplete();
            long duration = System.currentTimeMillis() - now;
            getLog().info("Successfully wrote Coveralls data in " + duration + "ms");
        } finally {
            writer.close();
        }
    }