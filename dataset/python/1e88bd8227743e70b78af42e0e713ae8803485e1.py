def csv(self, filename=None, **format_params):
        """Generates results in comma-separated form.  Write to ``filename``
        if given. Any other parameter will be passed on to ``csv.writer``.

        :param filename: if given, the CSV will be written to filename.

        Any additional keyword arguments will be passsed
        through to ``csv.writer``.
        """
        if not self.pretty:
            return None  # no results
        if filename:
            outfile = open(filename, 'w')
        else:
            outfile = StringIO()
        writer = UnicodeWriter(outfile, **format_params)
        writer.writerow(self.field_names)
        for row in self:
            writer.writerow(row)
        if filename:
            outfile.close()
            return CsvResultDescriptor(filename)
        else:
            return outfile.getvalue()