def clear(self):
        """
        Clear GDoc Spreadsheet by sending empty csv file.
        """
        empty_file_path = os.path.join(self.temp_path, 'empty.csv')
        try:
            empty_file = open(empty_file_path, 'w')
            empty_file.write(',')
            empty_file.close()
        except IOError as e:
            raise PODocsError(e)

        self._upload_file_to_gdoc(empty_file_path, content_type='text/csv')

        os.remove(empty_file_path)