func (c *Client) GetRequestStatus(path string) (*RequestStatus, error) {
	url := path + `?depth=` + c.client.depth + `&pretty=` + strconv.FormatBool(c.client.pretty)
	ret := &RequestStatus{}
	err := c.client.GetRequestStatus(url, ret, http.StatusOK)
	return ret, err
}