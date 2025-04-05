func getUserId(username string) (int, error) {
	url := fmt.Sprintf(USER_ID_PATH, API, username, APP_VERSION)
	res, err := http.Get(url)
	if err != nil {
		return 0, err
	}
	var data GetUserIdResponse
	json.NewDecoder(res.Body).Decode(&data)
	if !data.Success && data.Error != "" {
		return 0, errors.New(data.Error)
	}
	return data.UserId, nil
}