public static Object getMetricValue(
    MetricRegistry metrics,
    String metricId,
    MetricType metricType,
    MetricElement metricElement
  ) throws ObserverException {
    // We moved the logic of CURRENT_BATCH_AGE and TIME_IN_CURRENT_STAGE due to multi-threaded framework
    if(metricElement.isOneOf(MetricElement.CURRENT_BATCH_AGE, MetricElement.TIME_IN_CURRENT_STAGE)) {
      switch (metricElement) {
        case CURRENT_BATCH_AGE:
          return getTimeFromRunner(metrics, PipeRunner.METRIC_BATCH_START_TIME);
        case TIME_IN_CURRENT_STAGE:
          return getTimeFromRunner(metrics, PipeRunner.METRIC_STAGE_START_TIME);
        default:
          throw new IllegalStateException(Utils.format("Unknown metric type '{}'", metricType));
      }
    }

    // Default path
    Metric metric = getMetric(
        metrics,
        metricId,
        metricType
    );

    if(metric != null) {
      return getMetricValue(metricElement, metricType, metric);
    }

    return null;
  }