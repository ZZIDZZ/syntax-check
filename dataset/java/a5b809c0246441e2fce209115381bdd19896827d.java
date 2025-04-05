@SuppressWarnings("unchecked")
  private void launchActivity() {
    if (activity != null && ActivityRunMode.SPECIFICATION.equals(activityRunMode)) return;

    String targetPackage = instrumentation.getTargetContext().getPackageName();
    Intent intent = getLaunchIntent(targetPackage, activityClass, bundleCreator);

    activity = instrumentation.startActivitySync(intent);
    instrumentation.waitForIdleSync();
  }