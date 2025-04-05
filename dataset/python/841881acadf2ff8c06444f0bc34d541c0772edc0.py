def entity_name_decorator(top_cls):
    """
    Assign an entity name based on the class immediately inhering from Base.

    This is needed because we don't want
    entity names to come from any class that simply inherits our classes,
    just the ones in our module.

    For example, if you create a class Project2 that exists outside of
    kalibro_client and inherits from Project, it's entity name should still
    be Project.
    """
    class_name = inflection.underscore(top_cls.__name__).lower()

    def entity_name(cls):
        return class_name

    top_cls.entity_name = classmethod(entity_name)

    return top_cls