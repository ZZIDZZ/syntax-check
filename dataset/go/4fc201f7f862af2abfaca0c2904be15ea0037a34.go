func Resolve(u *url.URL) (*net.IPAddr, error) {
	host, _, err := SplitHostPort(u)
	if err != nil {
		return nil, err
	}

	addr, err := net.ResolveIPAddr("ip", host)
	if err != nil {
		return nil, err
	}

	return addr, nil
}