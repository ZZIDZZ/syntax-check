def parse(self):
        """Parse the MozillaClub spreadsheet feed cells json."""

        nevents_wrong = 0

        feed_json = json.loads(self.feed)

        if 'entry' not in feed_json['feed']:
            return

        self.cells = feed_json['feed']['entry']
        self.ncell = 0

        event_fields = self.__get_event_fields()

        # Process all events reading the rows according to the event template
        # The only way to detect the end of row is looking to the
        # number of column. When the max number is reached (cell_cols) the next
        # cell is from the next row.
        while self.ncell < len(self.cells):
            # Process the next row (event) getting all cols to build the event
            event = self.__get_next_event(event_fields)

            if event['Date of Event'] is None or event['Club Name'] is None:
                logger.warning("Wrong event data: %s", event)
                nevents_wrong += 1
                continue
            yield event

        logger.info("Total number of wrong events: %i", nevents_wrong)