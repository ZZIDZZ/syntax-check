def mark_begin_end_regex(regex, text, split_locations):
    """
    Regex that adds a 'SHOULD_SPLIT' marker at the end
    location of each matching group of the given regex,
    and adds a 'SHOULD_SPLIT' at the beginning of the
    matching group. Each character within the matching
    group will be marked as 'SHOULD_NOT_SPLIT'.

    Arguments
    ---------
        regex : re.Expression
        text : str, same length as split_locations
        split_locations : list<int>, split decisions.
    """
    for match in regex.finditer(text):
        end_match = match.end()
        begin_match = match.start()

        for i in range(begin_match+1, end_match):
            split_locations[i] = SHOULD_NOT_SPLIT
        if end_match < len(split_locations):
            if split_locations[end_match] == UNDECIDED:
                split_locations[end_match] = SHOULD_SPLIT
        if split_locations[begin_match] == UNDECIDED:
            split_locations[begin_match] = SHOULD_SPLIT