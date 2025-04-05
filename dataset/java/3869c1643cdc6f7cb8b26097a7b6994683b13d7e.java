public static String getBasename ( final String name )
    {
        if ( name == null )
        {
            return null;
        }

        final String[] toks = name.split ( "/" );
        if ( toks.length < 1 )
        {
            return name;
        }

        return toks[toks.length - 1];
    }