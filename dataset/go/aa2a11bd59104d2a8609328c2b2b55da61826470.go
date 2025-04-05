func New(seed int64) random.Interface {
	return &TTNRandom{
		Interface: &random.TTNRandom{
			Source: rand.New(rand.NewSource(seed)),
		},
	}
}