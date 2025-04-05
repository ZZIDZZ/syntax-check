def check_exc_info(self, node):
        """
        Reports a violation if exc_info keyword is used with logging.error or logging.exception.

        """
        if self.current_logging_level not in ('error', 'exception'):
            return

        for kw in node.keywords:
            if kw.arg == 'exc_info':
                if self.current_logging_level == 'error':
                    violation = ERROR_EXC_INFO_VIOLATION
                else:
                    violation = REDUNDANT_EXC_INFO_VIOLATION
                self.violations.append((node, violation))