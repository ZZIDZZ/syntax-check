public ByteArrayOutputStream toJSON() throws IOException
    {
        final ByteArrayOutputStream out = new ByteArrayOutputStream();
        mapper.writeValue(out, this);
        return out;
    }