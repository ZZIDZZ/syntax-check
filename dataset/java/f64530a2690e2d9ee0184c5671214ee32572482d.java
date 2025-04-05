public static String bytes2HexString(byte[] bytes) {
		StringBuffer resultBuffer = new StringBuffer();
		for (int i = 0; i < bytes.length; i++) {
			resultBuffer.append(byte2Hex(bytes[i]));
		}
		return resultBuffer.toString();
	}