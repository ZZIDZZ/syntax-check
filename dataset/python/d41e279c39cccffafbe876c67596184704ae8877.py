def get_rendition_key_set(key):
    """
    Retrieve a validated and prepped Rendition Key Set from
    settings.VERSATILEIMAGEFIELD_RENDITION_KEY_SETS
    """
    try:
        rendition_key_set = IMAGE_SETS[key]
    except KeyError:
        raise ImproperlyConfigured(
            "No Rendition Key Set exists at "
            "settings.VERSATILEIMAGEFIELD_RENDITION_KEY_SETS['{}']".format(key)
        )
    else:
        return validate_versatileimagefield_sizekey_list(rendition_key_set)