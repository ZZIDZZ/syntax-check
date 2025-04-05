public MeteoData<TextLocationWeather> fetchContent(double longitude, double latitude, TextLocationLanguage language)
            throws MeteoException {
        MeteoResponse response = getMeteoClient().fetchContent(
                createServiceUriBuilder()
                        .addParameter("latitude", latitude)
                        .addParameter("longitude", longitude)
                        .addParameter("language", language.getValue())
                        .build());
        return new MeteoData<>(parser.parse(response.getData()), response);
    }