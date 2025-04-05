public static <T> T[] arrayCopy(T[] items, int length, Class<T> tClass) {
        // Make an array of the appropriate size.  It's too bad that the JVM bothers to
        // initialize this with nulls.
        @SuppressWarnings("unchecked")
        T[] newItems = (T[]) ((tClass == null) ? new Object[length]
                                               : Array.newInstance(tClass, length) );

        // array-copy the items up to the new length.
        if (length > 0) {
            System.arraycopy(items, 0, newItems, 0,
                             items.length < length ? items.length
                                                   : length);
        }
        return newItems;
    }