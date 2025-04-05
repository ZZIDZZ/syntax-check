def reorder_resolved_levels(storage, debug):
    """L1 and L2 rules"""

    # Applies L1.

    should_reset = True
    chars = storage['chars']

    for _ch in chars[::-1]:
        # L1. On each line, reset the embedding level of the following
        # characters to the paragraph embedding level:
        if _ch['orig'] in ('B', 'S'):
            # 1. Segment separators,
            # 2. Paragraph separators,
            _ch['level'] = storage['base_level']
            should_reset = True
        elif should_reset and _ch['orig'] in ('BN', 'WS'):
            # 3. Any sequence of whitespace characters preceding a segment
            # separator or paragraph separator
            # 4. Any sequence of white space characters at the end of the
            # line.
            _ch['level'] = storage['base_level']
        else:
            should_reset = False

    max_len = len(chars)

    # L2 should be per line
    # Calculates highest level and loweset odd level on the fly.

    line_start = line_end = 0
    highest_level = 0
    lowest_odd_level = EXPLICIT_LEVEL_LIMIT

    for idx in range(max_len):
        _ch = chars[idx]

        # calc the levels
        char_level = _ch['level']
        if char_level > highest_level:
            highest_level = char_level

        if char_level % 2 and char_level < lowest_odd_level:
            lowest_odd_level = char_level

        if _ch['orig'] == 'B' or idx == max_len - 1:
            line_end = idx
            # omit line breaks
            if _ch['orig'] == 'B':
                line_end -= 1

            reverse_contiguous_sequence(chars, line_start, line_end,
                                        highest_level, lowest_odd_level)

            # reset for next line run
            line_start = idx+1
            highest_level = 0
            lowest_odd_level = EXPLICIT_LEVEL_LIMIT

    if debug:
        debug_storage(storage)