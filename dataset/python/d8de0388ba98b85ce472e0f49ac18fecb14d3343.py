async def normalize_postcode_middleware(request, handler):
    """
    If there is a postcode in the url it validates and normalizes it.
    """
    postcode: Optional[str] = request.match_info.get('postcode', None)

    if postcode is None or postcode == "random":
        return await handler(request)
    elif not is_uk_postcode(postcode):
        raise web.HTTPNotFound(text="Invalid Postcode")

    postcode_processed = postcode.upper().replace(" ", "")
    if postcode_processed == postcode:
        return await handler(request)
    else:
        url_name = request.match_info.route.name
        url = request.app.router[url_name]
        params = dict(request.match_info)
        params['postcode'] = postcode_processed
        raise web.HTTPMovedPermanently(str(url.url_for(**params)))