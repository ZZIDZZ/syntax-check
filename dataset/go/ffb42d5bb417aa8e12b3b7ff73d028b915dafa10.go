func Recover() Middleware {
	return func(next http.Handler) http.Handler {
		return http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
			defer func() {
				if v := recover(); v != nil {
					Store(r, PanicError{
						value: v,
						stack: stack(1),
					})
				}
			}()
			next.ServeHTTP(w, r)
		})
	}
}