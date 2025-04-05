def output(self, fieldNames=None, datemap=None, time_format=None):
        '''
        Output all fields using the fieldNames list. for fields in the list datemap indicates the field must
        be date
        '''

        count = self.printCursor(self._cursor, fieldNames, datemap, time_format)