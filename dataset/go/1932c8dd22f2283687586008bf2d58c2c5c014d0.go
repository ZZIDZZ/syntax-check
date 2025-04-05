func (drv *Driver) Open(name string) (driver.Conn, error) {
	conn, err := drv.Driver.Open(name)
	if err != nil {
		return conn, err
	}

	wrapped := &Conn{conn, drv.hooks}
	if isExecer(conn) && isQueryer(conn) && isSessionResetter(conn) {
		return &ExecerQueryerContextWithSessionResetter{wrapped,
			&ExecerContext{wrapped}, &QueryerContext{wrapped},
			&SessionResetter{wrapped}}, nil
	} else if isExecer(conn) && isQueryer(conn) {
		return &ExecerQueryerContext{wrapped, &ExecerContext{wrapped},
			&QueryerContext{wrapped}}, nil
	} else if isExecer(conn) {
		// If conn implements an Execer interface, return a driver.Conn which
		// also implements Execer
		return &ExecerContext{wrapped}, nil
	} else if isQueryer(conn) {
		// If conn implements an Queryer interface, return a driver.Conn which
		// also implements Queryer
		return &QueryerContext{wrapped}, nil
	}
	return wrapped, nil
}