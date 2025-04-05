public static void main(String[] args) {
    try {
      Stemming.useStemmer(new PTStemmer(), args);
    }
    catch (Exception e) {
      e.printStackTrace();
    }
  }