func IDFromString(s string) (ID, error) {
	i, err := strconv.ParseUint(s, 16, 64)
	return ID(i), err
}