func Send(addr string, auth smtp.Auth, m *Message) error {
	return smtp.SendMail(addr, auth, m.From.Address, m.Tolist(), m.Bytes())
}