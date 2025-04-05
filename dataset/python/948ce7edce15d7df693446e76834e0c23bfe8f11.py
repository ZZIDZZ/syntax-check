def set_logging_level(level=None):
    """Set neurosynth's logging level

    Args
      level : str
        Name of the logging level (warning, error, info, etc) known
        to logging module.  If no level provided, it would get that one
        from environment variable NEUROSYNTH_LOGLEVEL
    """
    if level is None:
        level = os.environ.get('NEUROSYNTH_LOGLEVEL', 'warn')
    if level is not None:
        logger.setLevel(getattr(logging, level.upper()))
    return logger.getEffectiveLevel()