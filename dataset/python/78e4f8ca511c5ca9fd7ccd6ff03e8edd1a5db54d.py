def init_logs():
    """Initiate log file."""
    start_time = dt.fromtimestamp(time.time()).strftime('%Y%m%d_%H%M')
    logname = os.path.join(os.path.expanduser("~") + "/nanoGUI_" + start_time + ".log")
    handlers = [logging.FileHandler(logname)]
    logging.basicConfig(
        format='%(asctime)s %(message)s',
        handlers=handlers,
        level=logging.INFO)
    logging.info('NanoGUI {} started with NanoPlot {}'.format(__version__, nanoplot.__version__))
    logging.info('Python version is: {}'.format(sys.version.replace('\n', ' ')))
    return logname