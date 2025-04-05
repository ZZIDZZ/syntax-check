def checksum(self):
        """
        Returns the unique SHA1 hexdigest of the chart URL param parts

        good for unittesting...
        """
        self.render()
        return new_sha(''.join(sorted(self._parts()))).hexdigest()