def xml_report(self, morfs=None, outfile=None, ignore_errors=None,
                    omit=None, include=None):
        """Generate an XML report of coverage results.

        The report is compatible with Cobertura reports.

        Each module in `morfs` is included in the report.  `outfile` is the
        path to write the file to, "-" will write to stdout.

        See `coverage.report()` for other arguments.

        Returns a float, the total percentage covered.

        """
        self._harvest_data()
        self.config.from_args(
            ignore_errors=ignore_errors, omit=omit, include=include,
            xml_output=outfile,
            )
        file_to_close = None
        delete_file = False
        if self.config.xml_output:
            if self.config.xml_output == '-':
                outfile = sys.stdout
            else:
                outfile = open(self.config.xml_output, "w")
                file_to_close = outfile
        try:
            try:
                reporter = XmlReporter(self, self.config)
                return reporter.report(morfs, outfile=outfile)
            except CoverageException:
                delete_file = True
                raise
        finally:
            if file_to_close:
                file_to_close.close()
                if delete_file:
                    file_be_gone(self.config.xml_output)