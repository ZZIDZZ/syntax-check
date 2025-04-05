public UrlBuilder queryParam(String name, String value, boolean encode) {
        if (StringUtils.isNotEmpty(value)) {
            if (encode) {
                try {
                    value = URLEncoder.encode(value, "UTF-8");
                } catch (UnsupportedEncodingException e) {
                    throw new IllegalStateException(e);
                }
            }
            params.add(new EntryImpl(name, value));
        }
        return this;
    }