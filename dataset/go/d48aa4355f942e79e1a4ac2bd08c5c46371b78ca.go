func uniquify(in []string) (out []string) {
	for _, i := range in {
		if i == "" {
			continue
		}
		for _, o := range out {
			if i == o {
				continue
			}
		}
		out = append(out, i)
	}
	return
}