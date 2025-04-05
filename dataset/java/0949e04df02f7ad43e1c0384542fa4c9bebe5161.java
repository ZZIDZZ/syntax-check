static int clamp(int value, int upperLimit) {
        if (value < 0) {
            return value + (-1 * (int) Math.floor(value / (float) upperLimit)) * upperLimit;
        } else {
            return value % upperLimit;
        }
    }