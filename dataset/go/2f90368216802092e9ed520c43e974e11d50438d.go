func (e *EventLog) Replay(s *Subscriber) {
	for i := 0; i < len((*e)); i++ {
		if string((*e)[i].ID) >= s.eventid {
			s.connection <- (*e)[i]
		}
	}
}