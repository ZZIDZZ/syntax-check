public int getAsByteArrayOffset() {
    if (position >= length)
      return -1;

    final int begin = position;

    final int size = OBinaryProtocol.bytes2int(buffer, position);
    position += OBinaryProtocol.SIZE_INT + size;

    return begin;
  }