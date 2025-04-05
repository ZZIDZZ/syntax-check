def repsep(parser: Union[Parser, Sequence[Input]], separator: Union[Parser, Sequence[Input]]) \
        -> RepeatedSeparatedParser:
    """Match a parser zero or more times separated by another parser.

    This matches repeated sequences of ``parser`` separated by ``separator``. A
    list is returned containing the value from each match of ``parser``. The
    values from ``separator`` are discarded. If there are no matches, an empty
    list is returned.

    Args:
        parser: Parser or literal
        separator: Parser or literal
    """
    if isinstance(parser, str):
        parser = lit(parser)
    if isinstance(separator, str):
        separator = lit(separator)
    return RepeatedSeparatedParser(parser, separator)