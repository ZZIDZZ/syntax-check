func UserLogin(c *gin.Context) {
	c.Header("X-Api-Correlation-Id", "1234")

	var json Login
	if c.BindJSON(&json) == nil {
		user, err := userRepository.ByUsername(json.User)
		if err != nil {
			c.JSON(http.StatusNotFound, gin.H{"status": "file not found"})
		} else if user.Username != json.User || user.Password != json.Password {
			c.JSON(http.StatusUnauthorized, gin.H{"status": "unauthorized"})
		} else {
			c.Header("X-Auth-Token", getAuthToken())
			c.JSON(http.StatusOK, types.LoginResponse{User: user})
		}
	}
}