public static void setSystemInfo(String key, String value) {
        if (systemInfoKeyMap.isEmpty() || !systemInfoKeyMap.containsKey(key)) {
            systemInfoKeyMap.put(key, false);
        }
        if (systemInfoKeyMap.get(key)) {
            return;
        }
        getExtentReport().setSystemInfo(key, value);
        systemInfoKeyMap.put(key, true);
    }