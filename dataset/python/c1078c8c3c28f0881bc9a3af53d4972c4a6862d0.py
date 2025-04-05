def quote_field(data, field):
    """
    Quote a field in a list of DNS records.
    Return the new data records.
    """
    if data is None:
        return None 

    data_dup = copy.deepcopy(data)
    for i in xrange(0, len(data_dup)):
        data_dup[i][field] = '"%s"' % data_dup[i][field]
        data_dup[i][field] = data_dup[i][field].replace(";", "\;")

    return data_dup