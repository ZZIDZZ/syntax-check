def brent(seqs, f=None, start=None, key=lambda x: x):
    """Brent's Cycle Detector.

    See help(cycle_detector) for more context.

    Args:

      *args: Two iterators issueing the exact same sequence:
      -or-
      f, start: Function and starting state for finite state machine

    Yields: 

      Values yielded by sequence_a if it terminates, undefined if a
      cycle is found.

    Raises:

      CycleFound if exception is found; if called with f and `start`,
      the parametres `first` and `period` will be defined indicating
      the offset of start of the cycle and the cycle's period.
    """

    power = period = 1
    tortise, hare = seqs

    yield hare.next()
    tortise_value = tortise.next()
    hare_value = hare.next()
    while key(tortise_value) != key(hare_value):
        yield hare_value
        if power == period:
            power *= 2
            period = 0
            if f:
                tortise = f_generator(f, hare_value)
                tortise_value = tortise.next()
            else:
                while tortise_value != hare_value:
                    tortise_value = tortise.next()
        hare_value = hare.next()
        period += 1

    if f is None:
        raise CycleDetected()

    first = 0
    tortise_value = hare_value = start
    for _ in xrange(period):
        hare_value = f(hare_value)

    while key(tortise_value) != key(hare_value):
        tortise_value = f(tortise_value)
        hare_value = f(hare_value)
        first += 1
    raise CycleDetected(period=period, first=first)