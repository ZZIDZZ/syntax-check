private static boolean anyValueDenied(Object[] values, HashMap<Permission, Result> resultMap) {
        if (values instanceof Permission[]) {
            Set<Permission> valueSet = new LinkedHashSet<>(Arrays.asList((Permission[]) values));
            if (resultMap.keySet().containsAll(valueSet)) {
                for (Object value : values) {
                    if (Result.DENIED == resultMap.get((Permission) value)) {
                        mLog.i(TAG, "denied - " + value.toString());
                        return true;
                    }
                }
            }
        } else if (values instanceof String[]) {
            Set<String> valueSet = new HashSet<>(Arrays.asList((String[]) values));
            Set<String> permissionSet = new HashSet<>();
            for (Permission perm : resultMap.keySet()) {
                permissionSet.add(perm.toString());
            }
            if (permissionSet.containsAll(valueSet)) {
                for (Object value : values) {
                    if (Result.DENIED == resultMap.get(Permission.get((String) value))) {
                        mLog.i(TAG, "denied - " + value);
                        return true;
                    }
                }
            }
        }
        return false;
    }