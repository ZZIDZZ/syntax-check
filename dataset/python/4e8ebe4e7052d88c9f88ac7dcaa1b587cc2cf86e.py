def is_subsequence(needle, haystack):
    """Are all the elements of needle contained in haystack, and in the same order?
    There may be other elements interspersed throughout"""
    it = iter(haystack)
    for element in needle:
        if element not in it:
            return False
    return True