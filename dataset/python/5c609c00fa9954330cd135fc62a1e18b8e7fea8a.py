def _format(self, object, stream, indent, allowance, context, level):
        """
        Recursive part of the formatting
        """
        try:
            PrettyPrinter._format(self, object, stream, indent, allowance, context, level)
        except Exception as e:
            stream.write(_format_exception(e))