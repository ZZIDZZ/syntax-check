def _handle_event(self, event, *args, **kw):
		"""Broadcast an event to the database connections registered."""
		
		for engine in self.engines.values():
			if hasattr(engine, event):
				getattr(engine, event)(*args, **kw)