private static Object[] rehash(final Object[] values, final int newSize)
    {
        Object[] newArray = new Object[newSize];

        for (Object value : values)
        {
            if (value == null)
            {
                continue;
            }

            newArray[predictedPosition(newArray, value, value.hashCode())] = value;
        }

        return newArray;
    }