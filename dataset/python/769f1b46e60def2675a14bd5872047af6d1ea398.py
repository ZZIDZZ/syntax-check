def amount(min=1, max=sys.maxsize, decimal_places=2):
    """
        return a random floating number

    :param min: minimum value
    :param max: maximum value
    :param decimal_places: decimal places
    :return:
    """
    q = '.%s1' % '0' * (decimal_places - 1)
    return decimal.Decimal(uniform(min, max)).quantize(decimal.Decimal(q))