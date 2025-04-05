def join_lines(string, strip=Strip.BOTH):
    '''
    Join strings together and strip whitespace in between if needed
    '''
    lines = []

    for line in string.splitlines():
        if strip & Strip.RIGHT:
            line = line.rstrip()

        if strip & Strip.LEFT:
            line = line.lstrip()

        lines.append(line)

    return ''.join(lines)