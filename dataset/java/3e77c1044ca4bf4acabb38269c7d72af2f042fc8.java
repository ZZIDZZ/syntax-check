@JsonCreator
  public static SizeRequest fromString(String str) throws ResolvingException {
    if (str.equals("full")) {
      return new SizeRequest();
    }
    if (str.equals("max")) {
      return new SizeRequest(true);
    }
    Matcher matcher = PARSE_PAT.matcher(str);
    if (!matcher.matches()) {
      throw new ResolvingException("Bad format: " + str);
    }
    if (matcher.group(1) != null) {
      if (matcher.group(1).equals("!")) {
        return new SizeRequest(
            Integer.valueOf(matcher.group(2)),
            Integer.valueOf(matcher.group(3)),
            true);
      } else if (matcher.group(1).equals("pct:")) {
        return new SizeRequest(new BigDecimal(matcher.group(4)));
      }
    }
    Integer width = null;
    Integer height = null;
    if (matcher.group(2) != null) {
      width = Integer.parseInt(matcher.group(2));
    }
    if (matcher.group(3) != null) {
      height = Integer.parseInt(matcher.group(3));
    }
    return new SizeRequest(width, height);
  }