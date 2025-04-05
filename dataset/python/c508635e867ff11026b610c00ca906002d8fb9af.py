def _unascii(s):
    """Unpack `\\uNNNN` escapes in 's' and encode the result as UTF-8

    This method takes the output of the JSONEncoder and expands any \\uNNNN
    escapes it finds (except for \\u0000 to \\u001F, which are converted to
    \\xNN escapes).

    For performance, it assumes that the input is valid JSON, and performs few
    sanity checks.
    """

    # make the fast path fast: if there are no matches in the string, the
    # whole thing is ascii. On python 2, that means we're done. On python 3,
    # we have to turn it into a bytes, which is quickest with encode('utf-8')
    m = _U_ESCAPE.search(s)
    if not m:
        return s if PY2 else s.encode('utf-8')

    # appending to a string (or a bytes) is slooow, so we accumulate sections
    # of string result in 'chunks', and join them all together later.
    # (It doesn't seem to make much difference whether we accumulate
    # utf8-encoded bytes, or strings which we utf-8 encode after rejoining)
    #
    chunks = []

    # 'pos' tracks the index in 's' that we have processed into 'chunks' so
    # far.
    pos = 0

    while m:
        start = m.start()
        end = m.end()

        g = m.group(1)

        if g is None:
            # escaped backslash: pass it through along with anything before the
            # match
            chunks.append(s[pos:end])
        else:
            # \uNNNN, but we have to watch out for surrogate pairs.
            #
            # On python 2, str.encode("utf-8") will decode utf-16 surrogates
            # before re-encoding, so it's fine for us to pass the surrogates
            # through. (Indeed we must, to deal with UCS-2 python builds, per
            # https://github.com/matrix-org/python-canonicaljson/issues/12).
            #
            # On python 3, str.encode("utf-8") complains about surrogates, so
            # we have to unpack them.
            c = int(g, 16)

            if c < 0x20:
                # leave as a \uNNNN escape
                chunks.append(s[pos:end])
            else:
                if PY3:   # pragma nocover
                    if c & 0xfc00 == 0xd800 and s[end:end + 2] == '\\u':
                        esc2 = s[end + 2:end + 6]
                        c2 = int(esc2, 16)
                        if c2 & 0xfc00 == 0xdc00:
                            c = 0x10000 + (((c - 0xd800) << 10) |
                                           (c2 - 0xdc00))
                            end += 6

                chunks.append(s[pos:start])
                chunks.append(unichr(c))

        pos = end
        m = _U_ESCAPE.search(s, pos)

    # pass through anything after the last match
    chunks.append(s[pos:])

    return (''.join(chunks)).encode("utf-8")