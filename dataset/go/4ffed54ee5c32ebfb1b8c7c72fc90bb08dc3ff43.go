func FindMachine(filename, name string) (*Machine, error) {
	mach, _, err := ParseFile(filename)
	if err != nil {
		return nil, err
	}
	var def *Machine
	for _, m := range mach {
		if m.Name == name {
			return m, nil
		}
		if m.Name == "" {
			def = m
		}
	}
	if def == nil {
		return nil, errors.New("no machine found")
	}
	return def, nil
}