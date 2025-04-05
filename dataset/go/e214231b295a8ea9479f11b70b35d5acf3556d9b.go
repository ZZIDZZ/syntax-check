func validateIdentifier(id string) error {
	if id != "" && !reIdentifier.MatchString(id) {
		return fmt.Errorf("%s is not a valid semver identifier", id)
	}
	return nil
}