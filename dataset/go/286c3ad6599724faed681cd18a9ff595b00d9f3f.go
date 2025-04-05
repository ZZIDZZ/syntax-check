func (e *EventController) IsHandlerRegistered(n string) bool {
	_, x := e.Handlers[n]
	return x
}