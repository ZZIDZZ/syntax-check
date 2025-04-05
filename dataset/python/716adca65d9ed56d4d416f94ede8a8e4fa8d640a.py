def autodetect_files(self):
        """ Attempt to detect requirements files in the current working directory """
        if self._is_valid_requirements_file('requirements.txt'):
            self.filenames.append('requirements.txt')

        if self._is_valid_requirements_file('requirements.pip'):  # pragma: nocover
            self.filenames.append('requirements.pip')

        if os.path.isdir('requirements'):
            for filename in os.listdir('requirements'):
                file_path = os.path.join('requirements', filename)
                if self._is_valid_requirements_file(file_path):
                    self.filenames.append(file_path)
        self._check_inclusions_recursively()