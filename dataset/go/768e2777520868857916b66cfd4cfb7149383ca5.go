func (s *PDClient) GetTask(taskID string) (task TaskResponse, res *http.Response, err error) {
	req, _ := s.createRequest("GET", fmt.Sprintf("%s/v1/task/%s", s.URL, taskID), bytes.NewBufferString(``))

	if res, err = s.client.Do(req); err == nil && res.StatusCode == http.StatusOK {
		resBodyBytes, _ := ioutil.ReadAll(res.Body)
		json.Unmarshal(resBodyBytes, &task)

	} else {
		lo.G.Error("client Do Error: ", err)
		lo.G.Error("client Res: ", res)
		err = ErrInvalidDispenserResponse
	}
	return
}