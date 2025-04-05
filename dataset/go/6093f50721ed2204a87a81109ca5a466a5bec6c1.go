func (c *Client) LeaveMUC(jid string) (n int, err error) {
	return fmt.Fprintf(c.conn, "<presence from='%s' to='%s' type='unavailable' />",
		c.jid, xmlEscape(jid))
}