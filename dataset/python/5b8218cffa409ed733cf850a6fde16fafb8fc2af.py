def discover(path, filter_specs=filter_specs):
    """
    Discover all of the specs recursively inside ``path``.

    Successively yields the (full) relative paths to each spec.

    """

    for dirpath, _, filenames in os.walk(path):
        for spec in filter_specs(filenames):
            yield os.path.join(dirpath, spec)