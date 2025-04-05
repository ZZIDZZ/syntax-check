public static URLFilters fromConf(Map stormConf) {

        String configFile = ConfUtils.getString(stormConf,
                "urlfilters.config.file");
        if (StringUtils.isNotBlank(configFile)) {
            try {
                return new URLFilters(stormConf, configFile);
            } catch (IOException e) {
                String message = "Exception caught while loading the URLFilters from "
                        + configFile;
                LOG.error(message);
                throw new RuntimeException(message, e);
            }
        }

        return URLFilters.emptyURLFilters;
    }