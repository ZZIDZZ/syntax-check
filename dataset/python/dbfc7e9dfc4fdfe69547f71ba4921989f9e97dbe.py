def gravatar_get_img(obj, size=65, default='identicon'):
    """Returns Gravatar image HTML tag for a given string or UserModel.

    Example:

        {% load gravatar %}
        {% gravatar_get_img user_model %}

    :param UserModel, str obj:
    :param int size:
    :param str default:
    :return:
    """
    url = get_gravatar_url(obj, size=size, default=default)
    if url:
        return safe('<img src="%s" class="gravatar">' % url)
    return ''