func convertAndAppendContextFuncs(o []func(context.Context) error, v ...interface{}) ([]func(context.Context) error, error) {
	for _, z := range v {
		var t func(context.Context) error
		switch f := z.(type) {
		case func(context.Context) error:
			t = f

		case func():
			t = func(context.Context) error {
				f()
				return nil
			}

		case func() error:
			t = func(context.Context) error {
				return f()
			}
		}

		if t == nil {
			return nil, ErrInvalidType
		}

		o = append(o, t)
	}
	return o, nil
}