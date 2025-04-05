func (m *MessageStream) parse() {
	for {
		b := <-m.pool.Full
		log.Debugf("Rcvd: %v", b.Bytes())
		msg, err := m.parser.Parse(b.Bytes())
		// Log all message parsing errors.
		if err != nil {
			log.Print(err)
		}

		m.Inbound <- msg
		b.Reset()
		m.pool.Empty <- b
	}
}