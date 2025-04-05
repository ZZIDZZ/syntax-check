public static void safeEncodeValue(final StringBuilder encoder, @Nullable final Object value) {
        if (value == null) {
            encoder.append("null");
        } else if (value instanceof Map) {
            safeEncodeMap(encoder, (Map<?, ?>) value);
        } else if (value instanceof List) {
            safeEncodeList(encoder, (List<?>) value);
        } else if (value.getClass().isArray()) {
            safeEncodeArray(encoder, value);
        } else if (value instanceof LogValueMapFactory.LogValueMap) {
            safeEncodeLogValueMap(encoder, (LogValueMapFactory.LogValueMap) value);
        } else if (value instanceof Throwable) {
            safeEncodeThrowable(encoder, (Throwable) value);
        } else if (StenoSerializationHelper.isSimpleType(value)) {
            if (value instanceof Boolean) {
                encoder.append(BooleanNode.valueOf((Boolean) value).toString());
            } else if (value instanceof Double) {
                encoder.append(DoubleNode.valueOf((Double) value).toString());
            } else if (value instanceof Float) {
                encoder.append(FloatNode.valueOf((Float) value).toString());
            } else if (value instanceof Long) {
                encoder.append(LongNode.valueOf((Long) value).toString());
            } else if (value instanceof Integer) {
                encoder.append(IntNode.valueOf((Integer) value).toString());
            } else {
                encoder.append(new TextNode(value.toString()).toString());
            }
        } else {
            safeEncodeValue(encoder, LogReferenceOnly.of(value).toLogValue());
        }
    }