def normalize(self, dt, is_dst=False):
        '''Correct the timezone information on the given datetime'''
        if dt.tzinfo is None:
            raise ValueError('Naive time - no tzinfo set')
        return dt.replace(tzinfo=self)