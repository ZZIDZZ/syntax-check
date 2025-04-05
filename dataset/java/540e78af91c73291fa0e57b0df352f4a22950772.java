private void initPwAuthenticator(final CommonProperties commonProps) {
        try {
            final String authNticatorClass = commonProps.getPasswordAuthenticatorClassName();
            if (authNticatorClass == null) {
                final String error = "No password authenticator class has been configured in the JAAS configuration";
                LOG.error(error);
                throw new IllegalStateException(error);
            } else {
                if (commonProps.isPasswordAuthenticatorSingleton()) {
                    // Fortify will report a violation here because of disclosure of potentially confidential
                    // information. However, the class name is not confidential, which makes this a non-issue / false
                    // positive.
                    LOG.debug("Requesting singleton authenticator class instance of '" + authNticatorClass
                            + "' from the authenticator factory");
                    this.pwAuthenticator = PasswordAuthenticatorFactory.getSingleton(authNticatorClass, commonProps);
                } else {
                    // Fortify will report a violation here because of disclosure of potentially confidential
                    // information. However, the class name is not confidential, which makes this a non-issue / false
                    // positive.
                    LOG.debug("Requesting non-singleton authenticator class instance of '" + authNticatorClass
                            + "' from the authenticator factory");
                    this.pwAuthenticator = PasswordAuthenticatorFactory.getInstance(authNticatorClass, commonProps);
                }
            }
        } catch (FactoryException e) {
            final String error = "The validator class cannot be instantiated. This is most likely a configuration"
                    + " problem. Is the configured class available in the classpath?";
            LOG.error(error, e);
            throw new IllegalStateException(error, e);
        }
    }