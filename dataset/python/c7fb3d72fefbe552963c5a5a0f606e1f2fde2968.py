def _create_regex(self, line, intent_name):
        """ Create regex and return. If error occurs returns None. """
        try:
            return re.compile(self._create_intent_pattern(line, intent_name),
                              re.IGNORECASE)
        except sre_constants.error as e:
            LOG.warning('Failed to parse the line "{}" '
                        'for {}'.format(line, intent_name))
            return None