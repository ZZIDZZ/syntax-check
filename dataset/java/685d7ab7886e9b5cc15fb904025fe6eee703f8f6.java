private void defineAmbiguity(String a) throws NotationException {
    Pattern patternAND = Pattern.compile("\\+");
    Matcher m = patternAND.matcher(a);

    /* mixture */
    if (m.find()) {
      setAmbiguity(new GroupingMixture(a));
    } /* or case */ else {
      setAmbiguity(new GroupingOr(a));
    }

  }