public static void loadFromStream(String key, Map<String, Object> output, InputStream binaryStream, String type)
            throws IOException {
        DataInputStream dis = new DataInputStream(binaryStream);
        String ckey = dis.readUTF();
        if (!key.equals(ckey)) {
            throw new IOException("Body Key does not match row key, unable to read");
        }
        readMapFromStream(output, dis);
        String cftype = null;
        try {
            cftype = dis.readUTF();
        } catch (IOException e) {
            LOGGER.debug("No type specified");
        }
        if (cftype != null && !cftype.equals(type)) {
            throw new IOException(
                    "Object is not of expected column family, unable to read expected [" + type
                            + "] was [" + cftype + "]");
        }
        LOGGER.debug("Finished Reading");
        dis.close();
        binaryStream.close();
    }