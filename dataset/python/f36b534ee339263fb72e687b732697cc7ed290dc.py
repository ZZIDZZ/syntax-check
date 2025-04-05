def attach(word, josa=EUN_NEUN):
    """add josa at the end of this word"""
    last_letter = word.strip()[-1]
    try:
        _, _, letter_jong = letter.decompose(last_letter)
    except NotHangulException:
        letter_jong = letter.get_substituent_of(last_letter)

    if letter_jong in ('', josa['except']):
        return word + josa['has']

    return word + josa['not']