def mult(p, n):
    """Returns a Pattern that matches exactly n repetitions of Pattern p.
    """
    np = P()
    while n >= 1:
        if n % 2:
            np = np + p
        p = p + p
        n = n // 2
    return np