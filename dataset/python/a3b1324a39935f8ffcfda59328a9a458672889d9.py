def follow(self):
        """
        Iterator generator that returns lines as data is added to the file.

        None will be yielded if no new line is available.
        Caller may either wait and re-try or end iteration.
        """
        trailing = True       
        
        while True:
            where = self.file.tell()

            if where > os.fstat(self.file.fileno()).st_size:
                # File was truncated.
                where = 0
                self.file.seek(where)

            line = self.file.readline()

            if line:    
                if trailing and line in self.LINE_TERMINATORS:
                    # This is just the line terminator added to the end of the file
                    # before a new line, ignore.
                    trailing = False
                    continue

                terminator = self.suffix_line_terminator(line)
                if terminator:
                    line = line[:-len(terminator)]

                trailing = False
                yield line
            else:
                trailing = True
                self.file.seek(where)
                yield None