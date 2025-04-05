func SortTypes(types []string) ([]string, error) {
	ts := &typeSorter{types: make([]string, len(types))}
	copy(ts.types, types)
	sort.Sort(ts)
	if ts.invalid {
		return types, ErrNotHierarchy
	}
	return ts.types, nil
}