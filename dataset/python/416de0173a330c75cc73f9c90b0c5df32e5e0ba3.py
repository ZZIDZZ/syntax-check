def select_source(self, source):
        """Select a source from the list of sources."""
        status = self.status()
        if status['power']:  # Changing source when off may hang NAD7050
            if status['source'] != source:  # Setting the source to the current source will hang the NAD7050
                if source in self.SOURCES:
                    self._send(self.CMD_SOURCE + self.SOURCES[source], read_reply=True)