public static void writeEnums(
      String fieldName, List<? extends ProtocolMessageEnum> enums, JsonGenerator gen)
      throws IOException {
    if (!enums.isEmpty()) {
      gen.writeArrayFieldStart(fieldName);
      for (ProtocolMessageEnum e : enums) {
        writeEnum(e, gen);
      }
      gen.writeEndArray();
    }
  }