func (u *MyUserModel) GetById(id interface{}) error {
	err := dbmap.SelectOne(u, "SELECT * FROM users WHERE id = $1", id)
	if err != nil {
		return err
	}

	return nil
}