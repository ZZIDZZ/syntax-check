def select_text(text, reading=False, prefer=None):
    """Select the correct text from the Japanese number, reading and
    alternatives"""
    # select kanji number or kana reading
    if reading:
        text = text[1]
    else:
        text = text[0]

    # select the preferred one or the first one from multiple alternatives
    if not isinstance(text, strtype):
        common = set(text) & set(prefer or set())
        if len(common) == 1:
            text = common.pop()
        else:
            text = text[0]

    return text