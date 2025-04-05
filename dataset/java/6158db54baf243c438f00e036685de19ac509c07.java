protected void checkMappings(int arrayPosition) {
        final int index = positions.indexOfValue(arrayPosition);
        if (index >= 0) {
            positions.removeAt(index);
        }
    }