def add_or_replace_filter(self, new_filter):
        """Replaces null or blank filter or adds filter to existing list."""
        if self.filter.lower() in self._FILTERS_TO_REPLACE:
            self.filter = new_filter
        elif new_filter not in self.filter.split(";"):
            self.filter = ";".join([self.filter,
                                    new_filter])