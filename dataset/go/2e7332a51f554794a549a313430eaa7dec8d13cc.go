func TokenHandler(next http.Handler, cnf web.Config) http.Handler {
	return http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		token, err := request.ParseFromRequest(r, request.AuthorizationHeaderExtractor, func(token *jwt.Token) (interface{}, error) {
			if _, ok := token.Method.(*jwt.SigningMethodHMAC); !ok {
				//TODO: On ne passe jamais à l'intérieur
				return nil, fmt.Errorf("Unexpected signing method: %v", token.Header["alg"])
			}
			return []byte(cnf.Jwt.Key), nil
		})
		if err == nil && token.Valid {
			next.ServeHTTP(w, r)
		} else {
			if r.URL.String() == "/" {
				next.ServeHTTP(w, r)
			} else {
				w.WriteHeader(http.StatusUnauthorized)
			}
		}
	})
}