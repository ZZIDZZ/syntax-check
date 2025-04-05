def move_to_end(self, key, last=True):
        """Move an existing key to the beginning or end of this ordered bidict.

        The item is moved to the end if *last* is True, else to the beginning.

        :raises KeyError: if the key does not exist
        """
        node = self._fwdm[key]
        node.prv.nxt = node.nxt
        node.nxt.prv = node.prv
        sntl = self._sntl
        if last:
            last = sntl.prv
            node.prv = last
            node.nxt = sntl
            sntl.prv = last.nxt = node
        else:
            first = sntl.nxt
            node.prv = sntl
            node.nxt = first
            sntl.nxt = first.prv = node