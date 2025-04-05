def cli_command_restart(self, msg):
        """\
        restart the subprocess
        i. we set our state to RESTARTING - on restarting we still send heartbeat
        ii. we kill the subprocess
        iii. we start again
        iv. if its started we set our state to RUNNING, else we set it to WAITING

        :param msg:
        :return:
        """
        info = ''
        if self.state == State.RUNNING and self.sprocess and self.sprocess.proc:
            self.state = State.RESTARTING
            self.sprocess.set_exit_callback(self.proc_exit_cb_restart)
            self.sprocess.proc.kill()
            info = 'killed'
            # TODO: check if process is really dead etc.
        return info