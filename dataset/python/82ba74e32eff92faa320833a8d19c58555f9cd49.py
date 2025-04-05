def error_parsing(msg="unknown options"):
    """
    Print any parsing error and exit with status -1
    """
    sys.stderr.write("Error parsing command line: %s\ntry 'mongotail --help' for more information\n" % msg)
    sys.stderr.flush()
    exit(EINVAL)