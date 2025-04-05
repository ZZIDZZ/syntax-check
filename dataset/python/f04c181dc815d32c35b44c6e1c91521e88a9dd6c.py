def get_suggestions(object):
    """ Gets a list of all suggestions for an object """
    content_type = ContentType.objects.get_for_model(type(object))
    return ObjectViewDictionary.objects.filter(
        current_object_id=object.id,
        current_content_type=content_type).extra(order_by=['-visits'])