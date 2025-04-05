func (self *UriTemplate) Names() []string {
	names := make([]string, 0, len(self.parts))

	for _, p := range self.parts {
		if len(p.raw) > 0 || len(p.terms) == 0 {
			continue
		}

		for _, term := range p.terms {
			names = append(names, term.name)
		}
	}

	return names
}