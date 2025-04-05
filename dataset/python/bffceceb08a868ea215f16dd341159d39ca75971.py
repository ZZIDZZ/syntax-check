def random_adjspecies_pair(maxlen=None, prevent_stutter=True):
    """
    Return an ordered 2-tuple containing a species and a describer.
    The letter-count of the pair is guarantee to not exceed `maxlen` if
    it is given. If `prevent_stutter` is True, the last letter of the
    first item of the pair will be different from the first letter of
    the second item.
    """
    while True:
        pair = _random_adjspecies_pair()
        if maxlen and len(''.join(pair)) > maxlen:
            continue
        if prevent_stutter and pair[0][-1] == pair[1][0]:
            continue
        return pair