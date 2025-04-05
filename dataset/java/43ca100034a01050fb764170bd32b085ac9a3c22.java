public static long readVLong(InputStream in) throws IOException {
        byte b = (byte)in.read();

        if(b == (byte) 0x80)
            throw new RuntimeException("Attempting to read null value as long");

        long value = b & 0x7F;
        while ((b & 0x80) != 0) {
          b = (byte)in.read();
          value <<= 7;
          value |= (b & 0x7F);
        }

        return value;
    }