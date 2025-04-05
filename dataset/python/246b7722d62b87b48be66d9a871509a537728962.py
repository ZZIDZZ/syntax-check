def encode(term, compressed=False):
    """Encode Erlang external term."""
    encoded_term = encode_term(term)
    # False and 0 do not attempt compression.
    if compressed:
        if compressed is True:
            # default compression level of 6
            compressed = 6
        elif compressed < 0 or compressed > 9:
            raise ValueError("invalid compression level: %r" % (compressed,))
        zlib_term = compress(encoded_term, compressed)
        ln = len(encoded_term)
        if len(zlib_term) + 5 <= ln:
            # Compressed term should be smaller
            return b"\x83P" + _int4_pack(ln) + zlib_term
    return b"\x83" + encoded_term