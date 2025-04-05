def get_gravatar_profile_url(email, secure=GRAVATAR_DEFAULT_SECURE):
    """
    Builds a url to a gravatar profile from an email address.

    :param email: The email to fetch the gravatar for
    :param secure: If True use https, otherwise plain http
    """
    if secure:
        url_base = GRAVATAR_SECURE_URL
    else:
        url_base = GRAVATAR_URL

    # Calculate the email hash
    email_hash = calculate_gravatar_hash(email)

    # Build url
    url = '{base}{hash}'.format(base=url_base, hash=email_hash)

    return url