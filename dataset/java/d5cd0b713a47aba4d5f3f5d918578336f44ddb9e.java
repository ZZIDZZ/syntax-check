public String getCrashLog() {
    String crashLogFileName = null;
    File crashLogFile = new File(getExternalStoragePath(), crashLogFileName);

    // the "test" utility doesn't exist on all devices so we'll check the
    // output of ls.
    CommandLine directoryListCommand = adbCommand("shell", "ls",
        crashLogFile.getParentFile().getAbsolutePath());
    String directoryList = executeCommandQuietly(directoryListCommand);
    if (directoryList.contains(crashLogFileName)) {
      return executeCommandQuietly(adbCommand("shell", "cat",
          crashLogFile.getAbsolutePath()));
    }

    return "";
  }