public static String formatLong(long number, int length) {
        return padLeft(format(Locale.US, "%,d", number), length);
    }