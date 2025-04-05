protected void addSystemProperty( Java java, String propertyName, File propertyValue )
    {
        Environment.Variable sysPropPlayHome = new Environment.Variable();
        sysPropPlayHome.setKey( propertyName );
        sysPropPlayHome.setFile( propertyValue );
        java.addSysproperty( sysPropPlayHome );
    }