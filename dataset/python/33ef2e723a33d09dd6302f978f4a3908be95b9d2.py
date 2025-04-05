def main():
    rollbar.init('ACCESS_TOKEN', environment='test', handler='twisted')

    """This runs the protocol on port 8000"""
    factory = protocol.ServerFactory()
    factory.protocol = Echo
    reactor.listenTCP(8000, factory)
    reactor.run()