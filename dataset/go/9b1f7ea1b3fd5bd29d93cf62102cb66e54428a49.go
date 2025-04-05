func (s *Seekret) LoadExceptionsFromFile(file string) error {
	var exceptionYamlList []exceptionYaml

	if file == "" {
		return nil
	}

	filename, _ := filepath.Abs(file)
	yamlData, err := ioutil.ReadFile(filename)
	if err != nil {
		return err
	}

	err = yaml.Unmarshal(yamlData, &exceptionYamlList)
	if err != nil {
		return err
	}

	for _, v := range exceptionYamlList {
		x := models.NewException()

		if v.Rule != nil {
			err := x.SetRule(*v.Rule)
			if err != nil {
				return err
			}
		}

		if v.Object != nil {
			err := x.SetObject(*v.Object)
			if err != nil {
				return err
			}
		}

		if v.Line != nil {
			err := x.SetNline(*v.Line)
			if err != nil {
				return err
			}
		}

		if v.Content != nil {
			err := x.SetContent(*v.Content)
			if err != nil {
				return err
			}
		}

		s.AddException(*x)
	}

	return nil
}