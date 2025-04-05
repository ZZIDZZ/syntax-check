func (c *Conn) Send(m *OutMsg) (n int, err error) {
	if m.ID == "" {
		if m.ID, err = getMsgID(); err != nil {
			return 0, err
		}
	}

	mb, err := json.Marshal(m)
	if err != nil {
		return 0, err
	}
	ms := string(mb)
	res := fmt.Sprintf(gcmMessageStanza, ms)
	return c.xmppConn.SendOrg(res)
}