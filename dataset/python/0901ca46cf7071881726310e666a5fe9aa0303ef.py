def parse(url):
    """Parses a database URL."""

    config = {}

    if not isinstance(url, six.string_types):
        url = ''

    url = urlparse.urlparse(url)

    # Remove query strings.
    path = url.path[1:]
    path = path.split('?', 2)[0]

    # Update with environment configuration.
    config.update({
        'NAME': path,
        'USER': url.username,
        'PASSWORD': url.password,
        'HOST': url.hostname,
        'PORT': url.port,
    })

    if url.scheme in SCHEMES:
        config['ENGINE'] = SCHEMES[url.scheme]

    return config