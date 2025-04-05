func (p *blockingPool) put(conn *WrappedConn) error {
	//in case that pool is closed and pool.conns is set to nil
	conns := p.conns
	if conns == nil {
		//conn.Conn is possibly nil coz factory() may fail, in which case conn is immediately 
		//put back to the pool
		if conn.Conn != nil {
			conn.Conn.Close()
			conn.Conn = nil
		}
		return ErrClosed
	}

	//if conn is marked unusable, underlying net.Conn is set to nil
	if conn.unusable {
		if conn.Conn != nil {
			conn.Conn.Close()
			conn.Conn = nil
		}
	}

	//It is impossible to block as number of connections is never more than length of channel
	conns <-conn
	return nil
}