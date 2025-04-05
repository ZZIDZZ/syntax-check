def throw(self, exception_class, should_throw):
        '''Defines if the an exception should be thrown after the request is sent

        Args:
            exception_class (class): The class of the exception to instantiate
            should_throw (function): The predicate that should indicate if the exception
                should be thrown. This function will be called with the response as a parameter

        Returns:
            The request builder instance in order to chain calls
        '''
        return self.__copy_and_set('throws', self._throws + [(exception_class, should_throw)])