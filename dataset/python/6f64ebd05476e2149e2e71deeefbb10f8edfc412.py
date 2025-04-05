def any_field_blank(function):
    """
    Sometimes return None if field could be blank
    """
    def wrapper(field, **kwargs):
        if kwargs.get('isnull', False):
            return None
    
        if field.blank and random.random < 0.1:
            return None
        return function(field, **kwargs)
    return wrapper