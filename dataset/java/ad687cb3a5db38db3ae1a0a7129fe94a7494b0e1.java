public void restore() {
    for (String propertyName : propertyNames) {
      if (restoreProperties.containsKey(propertyName)) {
        // reinstate the original value
        System.setProperty(propertyName, restoreProperties.get(propertyName));
      } else {
        // remove the (previously unset) property
        System.clearProperty(propertyName);
      }
    }
  }