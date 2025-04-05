def execute(self):
        """
        Execute R script
        """
        rprocess = OrderedDict()
        commands = OrderedDict([
            (self.file, ['Rscript', self.file] + self.cmd),
        ])
        for cmd_name, cmd in commands.items():
            rprocess[cmd_name] = self.run_command_under_r_root(cmd)
        
        return self.decode_cmd_out(completed_cmd=rprocess[self.file])