public static void checkCondition(boolean condition, String msg,
		Object... args)
	{
		if (!condition) {
			throw new IllegalArgumentException(format(msg, args));
		}
	}