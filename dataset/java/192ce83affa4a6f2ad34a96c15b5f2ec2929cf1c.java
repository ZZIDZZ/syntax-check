@Override
	public void position(final long newPosition) throws IOException {
		flush();
		if (repositionableStream != null) repositionableStream.position(newPosition);
		else if (fileChannel != null) fileChannel.position(newPosition);
		else throw new UnsupportedOperationException("position() can only be called if the underlying byte stream implements the RepositionableStream interface or if the getChannel() method of the underlying byte stream exists and returns a FileChannel");
	}