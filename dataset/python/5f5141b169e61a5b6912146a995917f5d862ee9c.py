def to_xml(self):
        """Encodes the stored ``data`` to XML and returns
        an ``lxml.etree`` value.
        """
        if self.data:
            self.document = self._update_document(self.document, self.data)

        return self.document