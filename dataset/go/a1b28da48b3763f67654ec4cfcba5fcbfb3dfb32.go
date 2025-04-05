func (s *Shell) PublishWithDetails(contentHash, key string, lifetime, ttl time.Duration, resolve bool) (*PublishResponse, error) {
	var pubResp PublishResponse
	req := s.Request("name/publish", contentHash).Option("resolve", resolve)
	if key != "" {
		req.Option("key", key)
	}
	if lifetime != 0 {
		req.Option("lifetime", lifetime)
	}
	if ttl.Seconds() > 0 {
		req.Option("ttl", ttl)
	}
	err := req.Exec(context.Background(), &pubResp)
	if err != nil {
		return nil, err
	}
	return &pubResp, nil
}