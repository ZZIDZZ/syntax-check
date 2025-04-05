func (p *Params) Parse(pvalue *reflect.Value) error {
	vtype := pvalue.Type().Elem()

	for idx := 0; idx < vtype.NumField(); idx++ {
		field := vtype.Field(idx)

		value := pvalue.Elem().Field(idx)

		if value.Kind() == reflect.Slice {
			value.Set(reflect.MakeSlice(value.Type(), 0, 0))
		}

		parameter := NewParameter(field.Name, value)
		if err := parameter.DiscoverProperties(field.Tag); err != nil {
			return err
		}

		if err := p.Set(parameter.Name, parameter); err != nil {
			return err
		}

		if parameter.Alias != "" {
			if err := p.Set(parameter.Alias, parameter); err != nil {
				return err
			}
		}
		p.Listing = append(p.Listing, parameter)
	}
	return nil
}