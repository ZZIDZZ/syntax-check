func Size() (w, h int, err error) {
	if !IsInit {
		err = errors.New("termsize not yet iniitialied")
		return
	}

	return get_size()
}