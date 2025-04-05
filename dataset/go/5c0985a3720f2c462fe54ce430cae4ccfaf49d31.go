func Do(d DB, f func(t Tx) error) error {
	t, err := d.TxBegin()
	if err != nil {
		return err
	}
	defer t.TxFinish()
	err = f(t)
	if err != nil {
		return err
	}
	return t.TxCommit()
}