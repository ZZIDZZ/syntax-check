func (s *Stack) String() string {
	buf := bytes.Buffer{}
	for k, v := range *s {
		fmt.Fprintf(&buf, "%03d: %q\n", k, v)
	}
	return buf.String()
}