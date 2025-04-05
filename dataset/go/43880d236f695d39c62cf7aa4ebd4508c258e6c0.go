func (e *VariableEWMA) Set(value float64) {
	e.value = value
	if e.count <= WARMUP_SAMPLES {
		e.count = WARMUP_SAMPLES + 1
	}
}