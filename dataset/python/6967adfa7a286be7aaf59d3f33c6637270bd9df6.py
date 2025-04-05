def get_items(self):
        """
        Iterator to read the rows of the CSV file.
        """
        # Get the csv reader
        reader = csv.reader(self.source)
        # Get the headers from the first line
        headers = reader.next()
        # Read each line yielding a dictionary mapping
        # the column headers to the row values
        for row in reader:
            # Skip empty rows
            if not row:
                continue
            yield dict(zip(headers, row))