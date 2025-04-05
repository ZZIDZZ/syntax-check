static void initializeFXMLLoader(final FXMLLoader fxmlLoader, final Class<?> targetClass, final String location, final String resources, final String charset) {

        checkAndSetLocation(fxmlLoader, targetClass, location);
        if (charset != null && !charset.equals(CHARSET_UNSPECIFIED)) {
            fxmlLoader.setCharset(Charset.forName(charset));
        }
        if (resources != null && !resources.equals(RESOURCES_UNSPECIFIED)) {
            fxmlLoader.setResources(ResourceBundle.getBundle(resources));
        }

    }