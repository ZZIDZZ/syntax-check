func (p *StepOverParams) Do(ctx context.Context) (err error) {
	return cdp.Execute(ctx, CommandStepOver, nil, nil)
}