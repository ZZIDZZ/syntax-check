protected Boolean asBooleanFromGlobalProp(String prop) {
        String value = getContext().getConfiguration().getProperty(prop);
        if (value == null) {
            value = System.getProperty(prop);
        }
        return value != null ? Boolean.valueOf(value) : null;
    }