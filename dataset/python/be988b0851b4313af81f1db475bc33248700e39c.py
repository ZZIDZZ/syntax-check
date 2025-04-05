def exchange(_context, component, backend, base, name=''):
        """Handle exchange subdirectives."""
        _context.action(
            discriminator=('currency', 'exchange', component),
            callable=_register_exchange,
            args=(name, component, backend, base)
        )