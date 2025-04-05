func Logger(next http.Handler) http.HandlerFunc {
	stdlogger := log.New(os.Stdout, "", 0)
	//errlogger := log.New(os.Stderr, "", 0)

	return func(w http.ResponseWriter, r *http.Request) {
		// Start timer
		start := time.Now()

		// Process request
		writer := statusWriter{w, 0}
		next.ServeHTTP(&writer, r)

		// Stop timer
		end := time.Now()
		latency := end.Sub(start)

		clientIP := r.RemoteAddr
		method := r.Method
		statusCode := writer.status
		statusColor := colorForStatus(statusCode)
		methodColor := colorForMethod(method)

		stdlogger.Printf("[HTTP] %v |%s %3d %s| %12v | %s |%s  %s %-7s %s\n",
			end.Format("2006/01/02 - 15:04:05"),
			statusColor, statusCode, reset,
			latency,
			clientIP,
			methodColor, reset, method,
			r.URL.Path,
		)
	}
}