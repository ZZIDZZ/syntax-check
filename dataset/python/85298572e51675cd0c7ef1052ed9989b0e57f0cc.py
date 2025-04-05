def create_adapter(cmph, ffi, obj):
    """ Generates a wrapped adapter for the given object

    Parameters
    ----------
    obj : list, buffer, array, or file

    Raises
    ------
    ValueError
        If presented with an object that cannot be adapted

    Returns
    -------
    CMPH capable adapter
    """

    # if arraylike and fixed unit size
    # if file
    # if buffer

    if is_file_location(obj):
        # The FP is captured for GC reasons inside the dtor closure
        # pylint: disable=invalid-name
        fd = open(obj)
        adapter = cmph.cmph_io_nlfile_adapter(fd)

        def dtor():
            cmph.cmph_io_nlfile_adapter_destroy(adapter)
            fd.close()

        # pylint: enable=invalid-name
        return _AdapterCxt(adapter, dtor)
    elif is_file(obj):
        adapter = cmph.cmph_io_nlfile_adapter(obj)
        dtor = lambda: cmph.cmph_io_nlfile_adapter_destroy(adapter)
        return _AdapterCxt(adapter, dtor)
    elif isinstance(obj, Sequence):
        if len(obj) == 0:
            raise ValueError("An empty sequence is already a perfect hash!")
        return _create_pyobj_adapter(cmph, ffi, obj)
    else:
        raise ValueError("data cannot have a cmph wrapper generated")