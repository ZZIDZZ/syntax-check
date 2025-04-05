func (c *Client) SetProjectConfig(projectName string, config ProjectConfig) error {
	return c.put(
		[]string{"project", projectName, "config"},
		config,
		nil,
	)
}