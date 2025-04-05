def options(self, my_psy):
        '''Returns all potential loop fusion options for the psy object
        provided'''
        # compute options dynamically here as they may depend on previous
        # changes to the psy tree
        my_options = []
        invokes = my_psy.invokes.invoke_list
        #print "there are {0} invokes".format(len(invokes))
        if self._dependent_invokes:
            raise RuntimeError(
                "dependent invokes assumes fusion in one invoke might "
                "affect fusion in another invoke. This is not yet "
                "implemented")
        else:
            # treat each invoke separately
            for idx, invoke in enumerate(invokes):
                print "invoke {0}".format(idx)
                # iterate through each outer loop
                for loop in invoke.schedule.loops():
                    if loop.loop_type == "outer":
                        siblings = loop.parent.children
                        my_index = siblings.index(loop)
                        option = []
                        self._recurse(siblings, my_index, option, my_options,
                                      invoke)

        return my_options