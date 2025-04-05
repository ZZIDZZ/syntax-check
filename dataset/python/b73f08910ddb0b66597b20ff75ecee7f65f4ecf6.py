def iter_resource(filename):
    """
    Return a stream for a given resource file in the module.

    The resource file has to be part of the module and its filenane given
    relative to the module.
    """
    with pkg_resources.resource_stream(__name__, filename) as resource:
        for line in resource:
            yield line.decode('utf-8')