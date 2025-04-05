func CurlAppRoot(cfg helpersinternal.CurlConfig, appName string) string {
	appCurler := helpersinternal.NewAppCurler(Curl, cfg)
	return appCurler.CurlAndWait(cfg, appName, "/", CURL_TIMEOUT)
}