func NewPlainClient(identity, username, password string) Client {
	return &plainClient{identity, username, password}
}