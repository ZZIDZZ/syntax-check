public static Method[] findMethods(String[] namesAndDescriptors, Method[] methods)
    {
        Map map = new HashMap();
        for (int i = 0; i < methods.length; i++) {
            Method method = methods[i];
            map.put(method.getName() + Type.getMethodDescriptor(method), method);
        }
        Method[] result = new Method[namesAndDescriptors.length / 2];
        for (int i = 0; i < result.length; i++) {
            result[i] = (Method)map.get(namesAndDescriptors[i * 2] + namesAndDescriptors[i * 2 + 1]);
            if (result[i] == null) {
                // TODO: error?
            }
        }
        return result;
    }