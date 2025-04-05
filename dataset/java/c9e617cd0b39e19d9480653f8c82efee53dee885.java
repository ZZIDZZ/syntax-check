public Name getPrefix(final int upperIndex)
    {
        if (upperIndex < 0 || upperIndex > components.size()) {
            throw new IllegalArgumentException("Index out of bounds");
        }
        return new Name(components.subList(0, upperIndex));
    }