def additional(self, additional, use_parent=False):
        """
        Allows temporarily pushing an additional context, yields the new context
        into the following block.
        """
        self.push(additional, use_parent)
        yield self.current
        self.pop()