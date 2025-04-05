def _translate_glob_part(pat):
    """Translate a glob PATTERN PART to a regular expression."""
    # Code modified from Python 3 standard lib fnmatch:
    if pat == '**':
        return '.*'
    i, n = 0, len(pat)
    res = []
    while i < n:
        c = pat[i]
        i = i + 1
        if c == '*':
            # Match anything but path separators:
            res.append('[^%s]*' % SEPARATORS)
        elif c == '?':
            res.append('[^%s]?' % SEPARATORS)
        elif c == '[':
            j = i
            if j < n and pat[j] == '!':
                j = j + 1
            if j < n and pat[j] == ']':
                j = j + 1
            while j < n and pat[j] != ']':
                j = j + 1
            if j >= n:
                res.append('\\[')
            else:
                stuff = pat[i:j].replace('\\', '\\\\')
                i = j + 1
                if stuff[0] == '!':
                    stuff = '^' + stuff[1:]
                elif stuff[0] == '^':
                    stuff = '\\' + stuff
                res.append('[%s]' % stuff)
        else:
            res.append(re.escape(c))
    return ''.join(res)