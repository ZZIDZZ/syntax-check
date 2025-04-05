@JsonIgnore
    public Map<String,List<String>> getAttributesMap() {
        Map<String,List<String>> rslt = new HashMap<>();
        for (NotificationAttribute a : attributes) {
            rslt.put(a.getName(), a.getValues());
        }
        return rslt;
    }