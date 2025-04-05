def logger(self, logger: typing.Union[logging.Logger, str, None]) -> None:
        """Logger instance to use as override."""
        if logger is None or isinstance(logger, logging.Logger):
            self.__logger = logger
        else:
            self.__logger = logging.getLogger(logger)