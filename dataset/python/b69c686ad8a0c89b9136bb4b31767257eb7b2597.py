def _prepare_command(self, cmd):
        """
        Construct the spark-sql command to execute. Verbose output is enabled
        as default.

        :param cmd: command to append to the spark-sql command
        :type cmd: str
        :return: full command to be executed
        """
        connection_cmd = ["spark-sql"]
        if self._conf:
            for conf_el in self._conf.split(","):
                connection_cmd += ["--conf", conf_el]
        if self._total_executor_cores:
            connection_cmd += ["--total-executor-cores", str(self._total_executor_cores)]
        if self._executor_cores:
            connection_cmd += ["--executor-cores", str(self._executor_cores)]
        if self._executor_memory:
            connection_cmd += ["--executor-memory", self._executor_memory]
        if self._keytab:
            connection_cmd += ["--keytab", self._keytab]
        if self._principal:
            connection_cmd += ["--principal", self._principal]
        if self._num_executors:
            connection_cmd += ["--num-executors", str(self._num_executors)]
        if self._sql:
            sql = self._sql.strip()
            if sql.endswith(".sql") or sql.endswith(".hql"):
                connection_cmd += ["-f", sql]
            else:
                connection_cmd += ["-e", sql]
        if self._master:
            connection_cmd += ["--master", self._master]
        if self._name:
            connection_cmd += ["--name", self._name]
        if self._verbose:
            connection_cmd += ["--verbose"]
        if self._yarn_queue:
            connection_cmd += ["--queue", self._yarn_queue]

        connection_cmd += cmd
        self.log.debug("Spark-Sql cmd: %s", connection_cmd)

        return connection_cmd