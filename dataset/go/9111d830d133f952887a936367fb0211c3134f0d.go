func Parse() {
	env := os.Environ()
	// Clean up and "fake" some flag k/v pairs.
	args := make([]string, 0, len(env))
	for _, value := range env {
		if Lookup(value[:strings.Index(value, "=")]) == nil {
			continue
		}
		args = append(args, fmt.Sprintf("-%s", value))
	}
	EnvironmentFlags.Parse(args)
}