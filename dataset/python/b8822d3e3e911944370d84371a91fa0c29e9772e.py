def calc_n_ints_in_file(filename):
    """ Calculate number of integrations in a given file """
    # Load binary data
    h = read_header(filename)
    n_bytes  = int(h[b'nbits'] / 8)

    n_chans = h[b'nchans']
    n_ifs   = h[b'nifs']
    idx_data = len_header(filename)
    f = open(filename, 'rb')
    f.seek(idx_data)
    filesize = os.path.getsize(filename)
    n_bytes_data = filesize - idx_data

    if h[b'nbits'] == 2:
        n_ints = int(4 * n_bytes_data / (n_chans * n_ifs))
    else:
        n_ints = int(n_bytes_data / (n_bytes * n_chans * n_ifs))

    return n_ints