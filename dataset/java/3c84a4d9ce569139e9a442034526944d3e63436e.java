public <T> T andProcessEntry(String entry, Function<InputStream, T> processor) {
    try (ZipFile zipFile = new ZipFile(zip)) {
      return processEntry(zipFile, entry, processor);
    } catch (IOException e) {
      throw new RuntimeIoException(e);
    }
  }