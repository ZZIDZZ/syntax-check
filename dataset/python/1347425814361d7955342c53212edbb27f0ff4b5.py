def del_arg(self, name: str) -> None:
        """Delete all arguments with the given then."""
        for arg in reversed(self.arguments):
            if arg.name.strip(WS) == name.strip(WS):
                del arg[:]