func Gzip(h http.Handler, opts ...Option) http.Handler {
	o := options{logger: handler.OutLogger()}
	o.apply(opts)

	return http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		if !strings.Contains(r.Header.Get("Accept-Encoding"), "gzip") {
			h.ServeHTTP(w, r)
			return
		}

		wrapper := handler.NewResponseWrapper(w)

		h.ServeHTTP(wrapper, r)

		for k, v := range wrapper.Header() {
			w.Header()[k] = v
		}
		w.Header().Set("Vary", "Accept-Encoding")
		w.Header().Set("Content-Encoding", "gzip")

		if w.Header().Get("Content-Type") == "" {
			w.Header().Set("Content-Type", http.DetectContentType(wrapper.Body.Bytes()))
		}
		w.Header().Del("Content-Length")

		if wrapper.Code != http.StatusOK {
			w.WriteHeader(wrapper.Code)
		}

		gz := gzip.NewWriter(w)
		gz.Flush()

		if _, err := gz.Write(wrapper.Body.Bytes()); err != nil {
			o.logger.Print("gzip handler: " + err.Error())
			http.Error(w, "Internal Server Error", http.StatusInternalServerError)
			return
		}

		gz.Close()
	})
}