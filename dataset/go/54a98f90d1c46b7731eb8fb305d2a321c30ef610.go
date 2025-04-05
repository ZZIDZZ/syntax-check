func SendToAdmins(c context.Context, msg *Message) error {
	return send(c, "SendToAdmins", msg)
}