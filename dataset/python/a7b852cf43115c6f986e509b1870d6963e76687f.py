def discover(scope, loglevel, capture):
    "Discover systems using WS-Discovery"

    if loglevel:
        level = getattr(logging, loglevel, None)
        if not level:
           print("Invalid log level '%s'" % loglevel)
           return
        logger.setLevel(level)

    run(scope=scope, capture=capture)