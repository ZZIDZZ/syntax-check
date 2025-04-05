def create_parser(self, prog_name, subcommand):
        """
        Create and return the ``ArgumentParser`` which will be used to
        parse the arguments to this command.

        """        
        parser = ArgumentParser(
            description=self.description,
            epilog=self.epilog,
            add_help=self.add_help,
            prog=self.prog,
            usage=self.get_usage(subcommand),
        )
        parser.add_argument('--version', action='version', version=self.get_version())
        self.add_arguments(parser)
        return parser