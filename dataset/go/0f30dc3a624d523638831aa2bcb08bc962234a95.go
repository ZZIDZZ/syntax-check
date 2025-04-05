func (config *Config) Run() {
	err := config.ensureLock()
	if err != nil {
		panic(err)
	}
	err = config.runWorker()
	if err != nil {
		panic(err)
	}
}