func CaptureMetrics(hnd http.Handler, w http.ResponseWriter, r *http.Request) Metrics {
	return CaptureMetricsFn(w, func(ww http.ResponseWriter) {
		hnd.ServeHTTP(ww, r)
	})
}