def api_returns(return_values):
    """
    Define the return schema of an API.

    'return_values' is a dictionary mapping
    HTTP return code => documentation
    In addition to validating that the status code of the response belongs to
    one of the accepted status codes, it also validates that the returned
    object is JSON (derived from JsonResponse)

    In debug and test modes, failure to validate the fields will result in a
    400 Bad Request response.
    In production mode, failure to validate will just log a
    warning, unless overwritten by a 'strict' setting.

    For example:

    @api_returns({
        200: 'Operation successful',
        403: 'User does not have persion',
        404: 'Resource not found',
        404: 'User not found',
    })
    def add(request, *args, **kwargs):
        if not request.user.is_superuser:
            return JsonResponseForbidden()  # 403

        return HttpResponse()  # 200
    """
    def decorator(func):
        @wraps(func)
        def wrapped_func(request, *args, **kwargs):
            return_value = func(request, *args, **kwargs)

            if not isinstance(return_value, JsonResponse):
                if settings.DEBUG:
                    return JsonResponseBadRequest('API did not return JSON')
                else:
                    logger.warn('API did not return JSON')

            accepted_return_codes = return_values.keys()
            # Never block 500s - these should be handled by other
            # reporting mechanisms
            accepted_return_codes.append(500)

            if return_value.status_code not in accepted_return_codes:
                if settings.DEBUG:
                    return JsonResponseBadRequest(
                        'API returned %d instead of acceptable values %s' %
                        (return_value.status_code, accepted_return_codes)
                    )
                else:
                    logger.warn(
                        'API returned %d instead of acceptable values %s',
                        return_value.status_code,
                        accepted_return_codes,
                    )

            return return_value
        return wrapped_func
    return decorator