def readPrefixArray(self, kind, numberOfTrees):
        """Read prefix code array"""
        prefixes = []
        for i in range(numberOfTrees):
            if kind==L: alphabet = LiteralAlphabet(i)
            elif kind==I: alphabet = InsertAndCopyAlphabet(i)
            elif kind==D: alphabet = DistanceAlphabet(
                i, NPOSTFIX=self.NPOSTFIX, NDIRECT=self.NDIRECT)
            self.readPrefixCode(alphabet)
            prefixes.append(alphabet)
        self.prefixCodes[kind] = prefixes