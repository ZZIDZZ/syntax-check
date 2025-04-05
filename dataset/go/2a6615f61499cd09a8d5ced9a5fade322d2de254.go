func (s *service) Create(params CreateParams) error {
	logicalStore := s.vaultClient.Logical()

	data := map[string]interface{}{
		"allowed_domains":    params.AllowedDomains,
		"allow_subdomains":   params.AllowSubdomains,
		"ttl":                params.TTL,
		"allow_bare_domains": params.AllowBareDomains,
		"organization":       params.Organizations,
	}

	_, err := logicalStore.Write(fmt.Sprintf("%s/roles/%s", s.pkiMountpoint, params.Name), data)
	if err != nil {
		return microerror.Mask(err)
	}
	return nil
}