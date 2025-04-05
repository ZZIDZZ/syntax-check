func (c APIClient) RestoreURL(url string) (retErr error) {
	restoreClient, err := c.AdminAPIClient.Restore(c.Ctx())
	if err != nil {
		return grpcutil.ScrubGRPC(err)
	}
	defer func() {
		if _, err := restoreClient.CloseAndRecv(); err != nil && retErr == nil {
			retErr = grpcutil.ScrubGRPC(err)
		}
	}()
	return grpcutil.ScrubGRPC(restoreClient.Send(&admin.RestoreRequest{URL: url}))
}