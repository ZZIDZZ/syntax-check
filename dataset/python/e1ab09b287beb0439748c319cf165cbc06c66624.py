def _parse_attr(self, tagname, attr, value):
        """
        Parse attribute. Delegate to href parser for hrefs, otherwise return
        value.
        """
        if tagname == 'a' and attr == 'href':
            return self._parse_href(value)
        else:
            return value