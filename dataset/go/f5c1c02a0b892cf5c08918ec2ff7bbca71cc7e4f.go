func (f *Fluent) connect() (err error) {
	host, port, err := net.SplitHostPort(f.Server)
	if err != nil {
		return err
	}
	addrs, err := net.LookupHost(host)
	if err != nil || len(addrs) == 0 {
		return err
	}
	// for DNS round robin
	n := Rand.Intn(len(addrs))
	addr := addrs[n]
	var format string
	if strings.Contains(addr, ":") {
		// v6
		format = "[%s]:%s"
	} else {
		// v4
		format = "%s:%s"
	}
	resolved := fmt.Sprintf(format, addr, port)
	log.Printf("[info] Connect to %s (%s)", f.Server, resolved)
	f.conn, err = net.DialTimeout("tcp", resolved, f.Config.Timeout)
	f.recordError(err)
	return
}