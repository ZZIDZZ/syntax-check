def default_value(field):
    '''
    When accessing to the name of the field itself, the value
    in the current language will be returned. Unless it's set,
    the value in the default language will be returned.
    '''

    def default_value_func(self):
        attname = lambda x: get_real_fieldname(field, x)

        if getattr(self, attname(get_language()), None):
            result = getattr(self, attname(get_language()))
        elif getattr(self, attname(get_language()[:2]), None):
            result = getattr(self, attname(get_language()[:2]))
        else:
            default_language = fallback_language()
            if getattr(self, attname(default_language), None):
                result = getattr(self, attname(default_language), None)
            else:
                result = getattr(self, attname(settings.LANGUAGE_CODE), None)
        return result

    return default_value_func