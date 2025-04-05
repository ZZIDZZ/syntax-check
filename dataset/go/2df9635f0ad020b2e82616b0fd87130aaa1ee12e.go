func (b *Bench) RunBenchmarks(r RequestFunc) {

	b.request = r
	results := b.internalRun(b.showProgress)
	b.processResults(results)
}