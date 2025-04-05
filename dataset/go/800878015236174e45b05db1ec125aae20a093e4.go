func NewAPIClient(cfg *Configuration) *APIClient {
	if cfg.HTTPClient == nil {
		cfg.HTTPClient = http.DefaultClient
	}

	c := &APIClient{}
	c.cfg = cfg
	c.common.client = c

	// API Services
	c.ServiceProviderConfigApi = (*ServiceProviderConfigApiService)(&c.common)
	c.UserApi = (*UserApiService)(&c.common)

	return c
}