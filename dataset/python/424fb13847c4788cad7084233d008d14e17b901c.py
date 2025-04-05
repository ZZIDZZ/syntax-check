def run(self, args=None):
        """
        Runs the command passing in the parsed arguments.

        :param args: The arguments to run the command with. If ``None`` the arguments
            are gathered from the argument parser. This is automatically set when calling
            sub commands and in most cases should not be set for the root command.

        :return: The status code of the action (0 on success)
        """
        args = args or self.parse_args()

        sub_command_name = getattr(args, self.sub_parser_dest_name, None)
        if sub_command_name:
            sub_commands = self.get_sub_commands()
            cmd_cls = sub_commands[sub_command_name]
            return cmd_cls(sub_command_name).run(args)

        return self.action(args) or 0