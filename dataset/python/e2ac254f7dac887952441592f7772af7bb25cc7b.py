def install_jinja_translations():
    """
    Install our gettext and ngettext functions into Jinja2's environment.
    """
    class Translation(object):
        """
        We pass this object to jinja so it can find our gettext implementation.
        If we pass the GNUTranslation object directly, it won't have our
        context and whitespace stripping action.
        """
        ugettext = staticmethod(ugettext)
        ungettext = staticmethod(ungettext)

    import jingo
    jingo.env.install_gettext_translations(Translation)