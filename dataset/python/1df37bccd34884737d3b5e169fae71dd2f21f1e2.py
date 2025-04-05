def get_information(self, about='stage'):
        """Get information about given keyword. Defaults to stage."""
        cmd = [
            ('cmd', 'getinfo'),
            ('dev', str(about))
        ]
        self.send(cmd)
        return self.wait_for(*cmd[1])