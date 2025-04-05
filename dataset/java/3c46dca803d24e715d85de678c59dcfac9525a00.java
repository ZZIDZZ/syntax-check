public static Database createFrom(
      String driver, String url, Map<String, ? extends Object> config) {
    return createFrom("default", driver, url, config);
  }