func Get(c *gin.Context) *url.URL {
	v, ok := c.Get(key)

	if !ok {
		return nil
	}

	vv, ok := v.(*url.URL)

	if !ok {
		return nil
	}

	return vv
}