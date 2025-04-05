def emit(self, record):
        """Emit a formatted log record via DDP."""
        if getattr(this, 'subs', {}).get(LOGS_NAME, False):
            self.format(record)
            this.send({
                'msg': ADDED,
                'collection': LOGS_NAME,
                'id': meteor_random_id('/collection/%s' % LOGS_NAME),
                'fields': {
                    attr: {
                        # typecasting methods for specific attributes
                        'args': lambda args: [repr(arg) for arg in args],
                        'created': datetime.datetime.fromtimestamp,
                        'exc_info': stacklines_or_none,
                    }.get(
                        attr,
                        lambda val: val  # default typecasting method
                    )(getattr(record, attr, None))
                    for attr in (
                        'args',
                        'asctime',
                        'created',
                        'exc_info',
                        'filename',
                        'funcName',
                        'levelname',
                        'levelno',
                        'lineno',
                        'module',
                        'msecs',
                        'message',
                        'name',
                        'pathname',
                        'process',
                        'processName',
                        'relativeCreated',
                        'thread',
                        'threadName',
                    )
                },
            })