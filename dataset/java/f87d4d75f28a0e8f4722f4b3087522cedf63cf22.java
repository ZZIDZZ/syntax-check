public void perform(List<AppInfo> apps, MetricDataRequest.TimeParams timeParams) {
        List<SignalFxProtocolBuffers.DataPoint> dataPoints = new LinkedList<>();
        for (AppInfo app : apps) {
            dataRequest.setAppName(app.name);
            for (MetricInfo metricInfo : app.metrics) {
                dataRequest.setTimeParams(timeParams);
                dataRequest.setMetricPath(metricInfo.metricPathQuery);

                List<MetricData> metricDataList;
                try {
                    metricDataList = dataRequest.get();
                } catch (RequestException e) {
                    // too bad
                    log.error("Metric query failure for \"{}\"", metricInfo.metricPathQuery);
                    counterAppDRequestFailure.inc();
                    continue;
                } catch (UnauthorizedException e) {
                    log.error("AppDynamics authentication failed");
                    return;
                }
                if (metricDataList != null && metricDataList.size() > 0) {
                    for (MetricData metricData : metricDataList) {
                        MetricTimeSeries mts =
                                metricInfo.getMetricTimeSeries(metricData.metricPath);
                        List<SignalFxProtocolBuffers.DataPoint> mtsDataPoints = processor
                                .process(mts, metricData.metricValues);
                        dataPoints.addAll(mtsDataPoints);
                        if (!mtsDataPoints.isEmpty()) {
                            counterMtsReported.inc();
                        } else {
                            counterMtsEmpty.inc();
                        }
                    }
                } else {
                    // no metrics found, something is wrong with selection
                    log.warn("No metric found for query \"{}\"", metricInfo.metricPathQuery);
                }
            }
        }
        if (!dataPoints.isEmpty()) {
            try {
                reporter.report(dataPoints);
                counterDataPointsReported.inc(dataPoints.size());
            } catch (Reporter.ReportException e) {
                log.error("There were errors reporting metric");
            }
        }
    }