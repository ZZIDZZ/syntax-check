def process_module(self, node):
        """Process the astroid node stream."""
        if self.config.file_header:
            if sys.version_info[0] < 3:
                pattern = re.compile(
                    '\A' + self.config.file_header, re.LOCALE | re.MULTILINE)
            else:
                # The use of re.LOCALE is discouraged in python 3
                pattern = re.compile(
                    '\A' + self.config.file_header, re.MULTILINE)

            content = None
            with node.stream() as stream:
                # Explicit decoding required by python 3
                content = stream.read().decode('utf-8')

            matches = pattern.findall(content)

            if len(matches) != 1:
                self.add_message('invalid-file-header', 1,
                                 args=self.config.file_header)