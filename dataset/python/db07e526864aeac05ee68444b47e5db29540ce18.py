def setup(self, app):
        """ Make sure that other installed plugins don't affect the same
            keyword argument and check if metadata is available."""
        for other in app.plugins:
            if not isinstance(other, AuthPlugin):
                continue
            if other.keyword == self.keyword:
                raise bottle.PluginError("Found another auth plugin "
                                         "with conflicting settings ("
                                         "non-unique keyword).")