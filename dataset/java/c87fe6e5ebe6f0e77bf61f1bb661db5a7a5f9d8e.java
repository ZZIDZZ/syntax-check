private static final void setPojoFieldValue(Object pojo, String setter, Object protobufValue, ProtobufAttribute protobufAttribute)
          throws InstantiationException, IllegalAccessException, JException
  {
    /**
     * convertCollectionFromProtoBufs() above returns an ArrayList, and we may have a converter to convert to a Set,
     * so we are performing the conversion there
     */
    final Class<? extends IProtobufConverter> fromProtoBufConverter = protobufAttribute.converter();
    if (fromProtoBufConverter != NullConverter.class)
    {
      final IProtobufConverter converter = fromProtoBufConverter.newInstance();
      protobufValue = converter.convertFromProtobuf(protobufValue);
    }

    Class<? extends Object> argClazz = protobufValue.getClass();

    JReflectionUtils.runSetter(pojo, setter, protobufValue, argClazz);
  }