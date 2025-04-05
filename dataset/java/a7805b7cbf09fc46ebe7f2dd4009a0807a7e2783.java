public static String removeKamolsMarkupFormating(String tag){
		String result = "";
		if (!tag.contains(",")) return "x";

		int depth = 0;
		int commas = 0;
		for (char c : tag.toCharArray()) {
			if (c=='[') depth++;
			if (c==']') depth--;
			if (depth == 1 && c==',') commas++;

			if (commas == 2) result = result + c;
		}

		result = result.replaceAll("_[A-Z0-9]*"   ,   "_");
		result = result.replaceAll("(\\[|\\]|\\,| )","");
		return result;
	}