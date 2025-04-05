def apply_to_str(self, obj):
        """
        Apply the config to a string.
        """
        toks = re.split('({config:|})', obj)
        newtoks = []
        try:
            while len(toks):
                tok = toks.pop(0)
                if tok == '{config:':
                    # pop the config variable, look it up
                    var = toks.pop(0)
                    val = self.config[var]

                    # if we got an empty node, then it didn't exist
                    if type(val) == ConfigNode and val == None:
                        raise KeyError("No such config variable '{}'".format(var))

                    # add the value to the list
                    newtoks.append(str(val))

                    # pop the '}'
                    toks.pop(0)
                else:
                    # not the start of a config block, just append it to the list
                    newtoks.append(tok)
            return ''.join(newtoks)
        except IndexError:
            pass

        return obj