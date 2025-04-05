function createDecodeStream(bufOrSchema) {
  let schema = null;
  const isBuffer = Buffer.isBuffer(bufOrSchema);

  if (!isBuffer) {
    schema = bufOrSchema;
  }

  const stream = new BinaryStream({
    transform: transformDecode,
    readableObjectMode: true,
    writableObjectMode: false,
  });

  stream[kschema] = schema;

  if (isBuffer) {
    stream.append(bufOrSchema);
  }

  return stream;
}