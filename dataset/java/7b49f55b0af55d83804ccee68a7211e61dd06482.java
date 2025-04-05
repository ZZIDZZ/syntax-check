private static Join<?, ?> findOrCreateJoin(String property, From<?, ?> from) {
        for (Join<?, ?> rootJoin : from.getJoins()) {
            if (rootJoin.getAttribute().getName().equals(property)) {
                return rootJoin;
            }
        }
        return from.join(property);
    }