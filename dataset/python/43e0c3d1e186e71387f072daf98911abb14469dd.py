def set_version(self, new_version: str):
        """
        Set the version for this given file.

        :param new_version: The new version string to set.
        """

        try:
            f = open(self.file_path, 'r')
            lines = f.readlines()
            f.close()
        except Exception as e:
            print(str(e))
            return

        for idx, line in enumerate(lines):
            if self.magic_line in line:
                start = len(self.magic_line)
                end = len(line) - self.strip_end_chars

                start_str = line[0:start]
                end_str = line[end:]
                lines[idx] = start_str + new_version + end_str

        try:
            f = open(self.file_path, 'w')
            f.writelines(lines)
            f.close()
        except Exception as e:
            print(str(e))
            return