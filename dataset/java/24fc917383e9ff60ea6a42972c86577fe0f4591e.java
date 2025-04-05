private static LibertyPropertyI getArquillianProperty(String key, Class<?> cls)
            throws ArquillianConfigurationException {
        try {
            if (cls == LibertyManagedObject.LibertyManagedProperty.class) {
                return LibertyManagedObject.LibertyManagedProperty.valueOf(key);
            } else if (cls == LibertyRemoteObject.LibertyRemoteProperty.class) {
                return LibertyRemoteObject.LibertyRemoteProperty.valueOf(key);
            }
        } catch (IllegalArgumentException e) {
            throw new ArquillianConfigurationException(
                    "Property \"" + key + "\" in arquillianProperties does not exist. You probably have a typo.");
        }
        throw new ArquillianConfigurationException("This should never happen.");
    }