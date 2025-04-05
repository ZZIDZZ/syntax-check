public void readFrom(InputStream is)
	throws IOException{
		DataInputStream dis = new DataInputStream(is);
		first = dis.readBoolean();
		zeroCounting = dis.readBoolean();
	}