def call_function(self, c, i):
        """
        Implement the CALL_FUNCTION_ operation.

        .. _CALL_FUNCTION: https://docs.python.org/3/library/dis.html#opcode-CALL_FUNCTION
        """

        callable_ = self.__stack[-1-i.arg]
        
        args = tuple(self.__stack[len(self.__stack) - i.arg:])
 
        self._print('call function')
        self._print('\tfunction ', callable_)
        self._print('\ti.arg    ', i.arg)
        self._print('\targs     ', args)

        self.call_callbacks('CALL_FUNCTION', callable_, *args)
   
        if isinstance(callable_, FunctionType):
            ret = callable_(*args)

        elif callable_ is builtins.__build_class__:
            ret = self.build_class(callable_, args)

        elif callable_ is builtins.globals:
            ret = self.builtins_globals()

        else:
            ret = callable_(*args)
        
        self.pop(1 + i.arg)
        self.__stack.append(ret)