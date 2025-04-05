private String createFxmlPath(Class<?> viewType) {
        final StringBuilder pathBuilder = new StringBuilder();

        final FxmlPath pathAnnotation = viewType.getDeclaredAnnotation(FxmlPath.class); //Get annotation from view
        final String fxmlPath = Optional.ofNullable(pathAnnotation)
                .map(FxmlPath::value)
                .map(String::trim)
                .orElse("");

        if (fxmlPath.isEmpty()) {
            pathBuilder.append("/");

            if (viewType.getPackage() != null) {
                pathBuilder.append(viewType.getPackage().getName().replaceAll("\\.", "/"));
                pathBuilder.append("/");
            }

            pathBuilder.append(viewType.getSimpleName());
            pathBuilder.append(".fxml");
        } else {
            pathBuilder.append(fxmlPath);
        }

        return pathBuilder.toString();
    }