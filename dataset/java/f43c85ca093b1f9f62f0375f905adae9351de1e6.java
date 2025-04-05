public JSONResult getJSON(URL url) {
    try {
      logger.debug("Requesting {}", url);
      StringBuilder text = new StringBuilder();
      String line;

      HttpURLConnection urlconn = (HttpURLConnection) url.openConnection();
      urlconn.setReadTimeout(msTimeout);
      urlconn.setConnectTimeout(msTimeout);
      urlconn.setRequestMethod("GET");
      urlconn.connect();
      BufferedReader br = new BufferedReader(new InputStreamReader(urlconn.getInputStream()));
      while ((line = br.readLine()) != null) {
        text.append(line);
      }
      return new JSONResult(text.toString());
    }
    catch (Throwable e) {
      throw new FireRESTException(url.toString(), e);
    }
  }