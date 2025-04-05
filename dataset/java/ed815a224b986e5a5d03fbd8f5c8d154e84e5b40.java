public static String detokenize(List<String> tokens) {
    return OpenKoreanTextProcessor.detokenize(JavaConverters.asScalaBufferConverter(tokens).asScala());
  }