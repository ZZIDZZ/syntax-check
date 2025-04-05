def default_formatter(error):
    """Escape the error, and wrap it in a span with class ``error-message``"""
    quoted = formencode.htmlfill.escape_formatter(error)
    return u'<span class="error-message">{0}</span>'.format(quoted)