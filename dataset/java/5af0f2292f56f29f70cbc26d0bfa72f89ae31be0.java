public static Properties parseArgs(Properties properties, String[] args)
    {
    	if (properties == null)
    		properties = new Properties();
        if (args == null)
            return properties;
        for (int i = 0; i < args.length; i++)
        	AppUtilities.addParam(properties, args[i], false);
        return properties;
    }