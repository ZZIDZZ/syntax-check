public static void cleanDirectByteBuffer(final ByteBuffer byteBuffer)
  {
	  
	if (byteBuffer == null) return;

    if (!byteBuffer.isDirect())
    	throw new IllegalArgumentException("byteBuffer isn't direct!");
    
    AccessController.doPrivileged(new PrivilegedAction<Void>() {
        public Void run() {
        	try
        	{
        		Method cleanerMethod = byteBuffer.getClass().getMethod("cleaner");
        	    cleanerMethod.setAccessible(true);
        	    Object cleaner = cleanerMethod.invoke(byteBuffer);
        	    Method cleanMethod = cleaner.getClass().getMethod("clean");
        	    cleanMethod.setAccessible(true);
        	    cleanMethod.invoke(cleaner);
        	}
        	catch (NoSuchMethodException | SecurityException | IllegalAccessException | IllegalArgumentException | InvocationTargetException e)
        	{
        		throw new RuntimeException("Could not clean MappedByteBuffer -- File may still be locked!");
        	}
           return null; // nothing to return
        }
    });


  }