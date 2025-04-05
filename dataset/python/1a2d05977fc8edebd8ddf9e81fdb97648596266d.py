def refresh(self):
        """ Refresh the list of blocks to the disk, collectively """
        if self.comm.rank == 0:
            self._blocks = self.list_blocks()
        else:
            self._blocks = None
        self._blocks = self.comm.bcast(self._blocks)