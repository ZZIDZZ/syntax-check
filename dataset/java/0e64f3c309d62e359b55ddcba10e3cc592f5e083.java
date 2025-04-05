public static String getMd5(final String text)  {
    try {

      final MessageDigest md = MessageDigest.getInstance("MD5");
      final byte[] utf8Bytes = text.getBytes(UTF_8_NAME);
      md.update(utf8Bytes, 0, utf8Bytes.length);
      final byte[] md5hash = md.digest();
      final int radix = 16;
      final int length = 32;

      final StringBuilder result = new StringBuilder(length).append(new BigInteger(1, md5hash).toString(radix));

      final int zeroBeginLen = length - result.length();
      if (zeroBeginLen > 0) {
        final char [] zeroBegin = new char[zeroBeginLen];
        Arrays.fill(zeroBegin, Character.forDigit(0, radix));
        result.insert(0, zeroBegin);
      }

      return result.toString();

    } catch (final NoSuchAlgorithmException|UnsupportedEncodingException e) {
      throw new AssertionError(e);
    }
  }