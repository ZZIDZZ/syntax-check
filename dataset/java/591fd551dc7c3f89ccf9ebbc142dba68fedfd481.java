private String normalizeResourceName(String name) {
        if (name.startsWith("//")) {
            return "classpath:" + name;
        }
        final int firstProtocol = name.indexOf("://");
        final int secondProtocol = name.indexOf("://", firstProtocol + 1);
        final int protocol = secondProtocol < 0 ? firstProtocol : secondProtocol;
        final int endOfFirst = name.lastIndexOf("/", protocol);
        if (endOfFirst >= 0) {
            return name.substring(endOfFirst + 1);
        }
        return name;
    }