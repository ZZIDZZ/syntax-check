def check_output(self, cmd):
        """Wrapper for subprocess.check_output."""
        ret, output = self._exec(cmd)
        if not ret == 0:
            raise CommandError(self)

        return output