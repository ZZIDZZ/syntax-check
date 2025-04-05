func OCSPServer(value ...string) Option {
	return func(c *configuration) {
		c.ocspServer = append(c.ocspServer, value...)
	}
}