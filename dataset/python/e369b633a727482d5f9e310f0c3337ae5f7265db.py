def decode_invocation_result(result):
    """ Tries to decode the values embedded in an invocation result dictionary. """
    if 'stack' not in result:
        return result
    result = copy.deepcopy(result)
    result['stack'] = _decode_invocation_result_stack(result['stack'])
    return result