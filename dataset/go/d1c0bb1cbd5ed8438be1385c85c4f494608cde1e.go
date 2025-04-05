func (m MongoDb) DeleteUser(username string) error {
	c := m.Connect(models.COLL_NAME_USER)
	defer m.Close(c)

	// raises error if "username" doesn't exist
	err := c.Remove(bson.M{"username": username})
	if err != nil {
		logger.Get().Error("Error deleting record from DB for user: %s. error: %v", username, err)
		return mkmgoerror(err.Error())
	}
	return err
}