def convert_value_to_standard_unit(value, symbol='i'):
    # type: (Text, Text) -> float
    """
    Converts between any two standard units of iota.

    :param value:
        Value (affixed) to convert. For example: '1.618 Mi'.

    :param symbol:
        Unit symbol of iota to convert to. For example: 'Gi'.

    :return:
        Float as units of given symbol to convert to.
    """
    try:
        # Get input value
        value_tuple = value.split()
        amount = float(value_tuple[0])
    except (ValueError, IndexError, AttributeError):
        raise with_context(
            ValueError('Value to convert is not valid.'),

            context={
                'value': value,
            },
        )

    try:
        # Set unit symbols and find factor/multiplier.
        unit_symbol_from = value_tuple[1]
        unit_factor_from = float(STANDARD_UNITS[unit_symbol_from])
        unit_factor_to = float(STANDARD_UNITS[symbol])
    except (KeyError, IndexError):
        # Invalid symbol or no factor
        raise with_context(
            ValueError('Invalid IOTA unit.'),

            context={
                'value': value,
                'symbol': symbol,
            },
        )

    return amount * (unit_factor_from / unit_factor_to)