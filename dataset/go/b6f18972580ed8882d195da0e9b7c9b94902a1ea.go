func (c *Client) Count(dataset, project, datasetTable string) int64 {
	qstr := fmt.Sprintf("select count(*) from [%s]", datasetTable)
	res, err := c.SyncQuery(dataset, project, qstr, 1)
	if err == nil {
		if len(res) > 0 {
			val, _ := strconv.ParseInt(res[0][0].(string), 10, 64)
			return val
		}
	}
	return 0
}