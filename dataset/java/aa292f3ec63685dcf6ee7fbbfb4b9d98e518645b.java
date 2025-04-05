private static String createFxmlPath(Class<?> viewType) {
        final StringBuilder pathBuilder = new StringBuilder();

        pathBuilder.append("/");

        if (viewType.getPackage() != null) {
            pathBuilder.append(viewType.getPackage().getName().replaceAll("\\.", "/"));
            pathBuilder.append("/");
        }

        pathBuilder.append(viewType.getSimpleName());
        pathBuilder.append(".fxml");

        return pathBuilder.toString();
    }