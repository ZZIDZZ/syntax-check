def to_scientific_tuple(number):
    """
    Return mantissa and exponent of a number in scientific notation.

    Full precision is maintained if the number is represented as a string

    :param number: Number
    :type  number: integer, float or string

    :rtype: named tuple in which the first item is the mantissa (*string*)
            and the second item is the exponent (*integer*) of the number
            when expressed in scientific notation

    For example:

        >>> import peng
        >>> peng.to_scientific_tuple('135.56E-8')
        NumComp(mant='1.3556', exp=-6)
        >>> peng.to_scientific_tuple(0.0000013556)
        NumComp(mant='1.3556', exp=-6)
    """
    # pylint: disable=W0632
    convert = not isinstance(number, str)
    # Detect zero and return, simplifies subsequent algorithm
    if (convert and (number == 0)) or (
        (not convert) and (not number.strip("0").strip("."))
    ):
        return ("0", 0)
    # Break down number into its components, use Decimal type to
    # preserve resolution:
    # sign  : 0 -> +, 1 -> -
    # digits: tuple with digits of number
    # exp   : exponent that gives null fractional part
    sign, digits, exp = Decimal(str(number) if convert else number).as_tuple()
    mant = (
        "{sign}{itg}{frac}".format(
            sign="-" if sign else "",
            itg=digits[0],
            frac=(
                ".{frac}".format(frac="".join([str(num) for num in digits[1:]]))
                if len(digits) > 1
                else ""
            ),
        )
        .rstrip("0")
        .rstrip(".")
    )
    exp += len(digits) - 1
    return NumComp(mant, exp)