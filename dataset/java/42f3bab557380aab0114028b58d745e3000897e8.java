private EventSerializer getEventSerializer(final GZIPInputStream inputStream, final CloudTrailLog ctLog)
            throws IOException {
        final EventSerializer serializer;

        if (isEnableRawEventInfo) {
            final String logFileContent = new String(LibraryUtils.toByteArray(inputStream), StandardCharsets.UTF_8);
            final JsonParser jsonParser = this.mapper.getFactory().createParser(logFileContent);
            serializer = new RawLogDeliveryEventSerializer(logFileContent, ctLog, jsonParser);
        }
        else {
            final JsonParser jsonParser = this.mapper.getFactory().createParser(inputStream);
            serializer = new DefaultEventSerializer(ctLog, jsonParser);
        }

        return serializer;
    }