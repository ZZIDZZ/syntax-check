def server_error(request_id, error):
    """JSON-RPC server error.

    :param request_id: JSON-RPC request id
    :type request_id: int or str or None
    :param error: server error
    :type error: Exception

    """

    response = {
        'jsonrpc': '2.0',
        'id': request_id,
        'error': {
            'code': -32000,
            'message': 'Server error',
            'data': repr(error),
        },
    }
    raise ServiceException(500, dumps(response))