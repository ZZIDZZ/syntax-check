public String convertToJson(Properties properties, String... includeDomainKeys) throws ParsePropertiesException {
        return convertFromValuesAsObjectMap(propertiesToMap(properties), includeDomainKeys);
    }