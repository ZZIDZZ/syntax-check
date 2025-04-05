def _saslprep_do_mapping(chars):
    """
    Perform the stringprep mapping step of SASLprep. Operates in-place on a
    list of unicode characters provided in `chars`.
    """
    i = 0
    while i < len(chars):
        c = chars[i]
        if stringprep.in_table_c12(c):
            chars[i] = "\u0020"
        elif stringprep.in_table_b1(c):
            del chars[i]
            continue
        i += 1