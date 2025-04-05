def tag_list(self, tags):
        """
        Generates a list of tags identifying those previously selected.

        Returns a list of tuples of the form (<tag name>, <CSS class name>).

        Uses the string names rather than the tags themselves in order to work
        with tag lists built from forms not fully submitted.
        """
        return [
            (tag.name, "selected taggit-tag" if tag.name in tags else "taggit-tag")
            for tag in self.model.objects.all()
        ]