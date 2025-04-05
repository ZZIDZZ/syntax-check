func (mw *AccessLogJsonMiddleware) MiddlewareFunc(h HandlerFunc) HandlerFunc {

	// set the default Logger
	if mw.Logger == nil {
		mw.Logger = log.New(os.Stderr, "", 0)
	}

	return func(w ResponseWriter, r *Request) {

		// call the handler
		h(w, r)

		mw.Logger.Printf("%s", makeAccessLogJsonRecord(r).asJson())
	}
}