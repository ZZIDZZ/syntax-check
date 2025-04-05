def uploading_request(verb, path, data=None, files=None, timeout=conf.DEFAULT):
    """Makes Uploading API request and returns response as ``dict``.

    It takes settings from ``conf`` module.

    Make sure that given ``path`` does not contain leading slash.

    Usage example::

        >>> file_obj = open('photo.jpg', 'rb')
        >>> uploading_request('POST', 'base/', files={'file': file_obj})
        {
            'file': '9b9f4483-77b8-40ae-a198-272ba6280004'
        }
        >>> File('9b9f4483-77b8-40ae-a198-272ba6280004')

    """
    path = path.lstrip('/')
    url = urljoin(conf.upload_base, path)

    if data is None:
        data = {}
    data['pub_key'] = conf.pub_key
    data['UPLOADCARE_PUB_KEY'] = conf.pub_key

    headers = {
        'User-Agent': _build_user_agent(),
    }

    try:
        response = session.request(
            str(verb), url, allow_redirects=True,
            verify=conf.verify_upload_ssl, data=data, files=files,
            headers=headers, timeout=_get_timeout(timeout),
        )
    except requests.RequestException as exc:
        raise APIConnectionError(exc.args[0])

    # No content.
    if response.status_code == 204:
        return {}

    if 200 <= response.status_code < 300:
        if _content_type_from_response(response).endswith(('/json', '+json')):
            try:
                return response.json()
            except ValueError as exc:
                raise APIError(exc.args[0])

    if response.status_code in (400, 404):
        raise InvalidRequestError(response.content)

    # Not json or unknown status code.
    raise APIError(response.content)