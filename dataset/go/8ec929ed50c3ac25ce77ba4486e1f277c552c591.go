func Between(time1, time2 string) bool {
	return New(time.Now()).Between(time1, time2)
}