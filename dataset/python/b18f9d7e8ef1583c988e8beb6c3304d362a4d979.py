def convertArgsToTokens(self, data):
        """
        this converts the readin lines from
        sys to useable format, returns list
        of token and dict of tokens
        """

        tdict = []
        tokens = []

        d = open(data, 'r')
        for line in d.readlines():
            tdict.append(line.rstrip())
            tokens += line.split()

        d.close()
        tokens = list(set(tokens))

        return tdict, tokens