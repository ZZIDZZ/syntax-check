def find_ledger_file(ledgerrcpath=None):
    """Returns main ledger file path or raise exception if it cannot be \
found."""
    if ledgerrcpath is None:
        ledgerrcpath = os.path.abspath(os.path.expanduser("~/.ledgerrc"))
    if "LEDGER_FILE" in os.environ:
        return os.path.abspath(os.path.expanduser(os.environ["LEDGER_FILE"]))
    elif os.path.exists(ledgerrcpath):
        # hacky
        ledgerrc = open(ledgerrcpath)
        for line in ledgerrc.readlines():
            md = re.match(r"--file\s+([^\s]+).*", line)
            if md is not None:
                return os.path.abspath(os.path.expanduser(md.group(1)))
    else:
        return None