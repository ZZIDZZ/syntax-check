func Nest(path string, err error) error {
	if ag, ok := err.(AggregateError); ok {
		var errs AggregateError
		for _, e := range ag {
			errs = append(errs, Nest(path, e))
		}
		return errs
	}
	if ne, ok := err.(*NestedError); ok {
		return &NestedError{
			Path: path + ne.Path,
			Err:  ne.Err,
		}
	}
	return &NestedError{
		Path: path,
		Err:  err,
	}
}