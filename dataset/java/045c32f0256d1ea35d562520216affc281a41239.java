public static void dispatchDescriptor(
        final RecordingDescriptorDecoder decoder, final RecordingDescriptorConsumer consumer)
    {
        consumer.onRecordingDescriptor(
            decoder.controlSessionId(),
            decoder.correlationId(),
            decoder.recordingId(),
            decoder.startTimestamp(),
            decoder.stopTimestamp(),
            decoder.startPosition(),
            decoder.stopPosition(),
            decoder.initialTermId(),
            decoder.segmentFileLength(),
            decoder.termBufferLength(),
            decoder.mtuLength(),
            decoder.sessionId(),
            decoder.streamId(),
            decoder.strippedChannel(),
            decoder.originalChannel(),
            decoder.sourceIdentity());
    }