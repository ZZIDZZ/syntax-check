def create_validator(data_struct_dict, name=None):
    """
    create a Validator instance from data_struct_dict

    :param data_struct_dict: a dict describe validator's fields, like the dict `to_dict()` method returned.
    :param name: name of Validator class 

    :return: Validator instance
    """

    if name is None:
        name = 'FromDictValidator'
    attrs = {}
    for field_name, field_info in six.iteritems(data_struct_dict):
        field_type = field_info['type']
        if field_type == DictField.FIELD_TYPE_NAME and isinstance(field_info.get('validator'), dict):
            field_info['validator'] = create_validator(field_info['validator'])
        attrs[field_name] = create_field(field_info)
    name = force_str(name)
    return type(name, (Validator, ), attrs)