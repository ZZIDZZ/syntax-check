def cli_parse(file_path, sa, nameservers, dns_timeout, parallel=False):
    """Separated this function for multiprocessing"""
    try:
        file_results = parse_report_file(file_path,
                                         nameservers=nameservers,
                                         dns_timeout=dns_timeout,
                                         strip_attachment_payloads=sa,
                                         parallel=parallel)
    except ParserError as error:
        return error, file_path
    finally:
        global counter
        with counter.get_lock():
            counter.value += 1
    return file_results, file_path