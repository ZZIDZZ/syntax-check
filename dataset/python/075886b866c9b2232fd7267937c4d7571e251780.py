def error(self, message, code=1):
        """
        Print error and stop command
        """
        print >>sys.stderr, message
        sys.exit(code)