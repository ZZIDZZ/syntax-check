@NonNull
  public static <T> Try<T> trySuccess(final Class<T> type) {
    assertIsNotParameterized(type, msgInline("trySuccess"));
    return Try.success(Any.instanceOf(type));
  }