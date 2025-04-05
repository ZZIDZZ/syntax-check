func (cbr *OutgoingCallbackQueryResponse) Send() error {
	resp := &baseResponse{}
	_, err := cbr.api.c.postJSON(answerCallbackQuery, resp, cbr)

	if err != nil {
		return err
	}

	return check(resp)
}