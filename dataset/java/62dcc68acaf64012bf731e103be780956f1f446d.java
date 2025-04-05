public static void setSchema(Job job, Schema schema) {
    AvroWriteSupport.setSchema(ContextUtil.getConfiguration(job), schema);
  }