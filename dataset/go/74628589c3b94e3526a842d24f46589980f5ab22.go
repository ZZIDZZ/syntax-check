func (d *Document) Pristine() *Document {
	dd, _ := Analyzed(d.Raw(), d.Version())
	return dd
}