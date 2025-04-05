func NewRClientWithAuth(host string, port int64, user, password string) (RClient, error) {
	addr, err := net.ResolveTCPAddr("tcp", host+":"+strconv.FormatInt(port, 10))
	if err != nil {
		return nil, err
	}

	rClient := &roger{
		address:  addr,
		user:     user,
		password: password,
	}

	if _, err = rClient.Eval("'Test session connection'"); err != nil {
		return nil, err
	}
	return rClient, nil
}