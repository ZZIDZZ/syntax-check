def handle(self, *args, **options):
        """Handle CLI command"""
        try:
            while True:
                Channel(HEARTBEAT_CHANNEL).send({'time':time.time()})
                time.sleep(HEARTBEAT_FREQUENCY)
        except KeyboardInterrupt:
            print("Received keyboard interrupt, exiting...")