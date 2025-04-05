def __new_argv(self, *new_pargs, **new_kargs):
        """Calculate new argv and extra_argv values resulting from adding
        the specified positional and keyword arguments."""

        new_argv = self.argv.copy()
        new_extra_argv = list(self.extra_argv)

        for v in new_pargs:
            arg_name = None
            for name in self.pargl:
                if not name in new_argv:
                    arg_name = name
                    break

            if arg_name:
                new_argv[arg_name] = v
            elif self.var_pargs:
                new_extra_argv.append(v)
            else:
                num_prev_pargs = len([name for name in self.pargl if name in self.argv])
                raise TypeError("%s() takes exactly %d positional arguments (%d given)" \
                                    % (self.__name__,
                                       len(self.pargl),
                                       num_prev_pargs + len(new_pargs)))

        for k,v in new_kargs.items():
            if not (self.var_kargs or (k in self.pargl) or (k in self.kargl)):
                raise TypeError("%s() got an unexpected keyword argument '%s'" \
                                    % (self.__name__, k))
            new_argv[k] = v

        return (new_argv, new_extra_argv)