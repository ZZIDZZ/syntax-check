func (b *Bag) Has(key string) bool {
	_, ok := (*b)[key]

	return ok
}