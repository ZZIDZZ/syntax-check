def create(source, link_name):
    """
    Create a junction at link_name pointing to source.
    """
    success = False
    if not os.path.isdir(source):
        raise Exception("%s is not a directory" % source)
    if os.path.exists(link_name):
        raise Exception("%s: junction link name already exists" % link_name)

    link_name = os.path.abspath(link_name)
    os.mkdir(link_name)

    # Get a handle to the directory
    hlink = CreateFile(link_name, fs.GENERIC_WRITE,
        fs.FILE_SHARE_READ | fs.FILE_SHARE_WRITE, None, fs.OPEN_EXISTING,
        fs.FILE_FLAG_OPEN_REPARSE_POINT | fs.FILE_FLAG_BACKUP_SEMANTICS,
        None)
    try:
        if hlink == fs.INVALID_HANDLE_VALUE:
            raise WinError()

        srcvolpath = unparsed_convert(source)
        (junctioninfo, infolen) = new_junction_reparse_buffer(srcvolpath)

        dummy = DWORD(0)
        res = DeviceIoControl(
            hlink,
            FSCTL_SET_REPARSE_POINT,
            byref(junctioninfo),
            infolen,
            None,
            0,
            byref(dummy),
            None)

        if res == 0:
            raise WinError()
        success = True
    finally:
        if hlink != fs.INVALID_HANDLE_VALUE:
            CloseHandle(hlink)
        if not success:
            os.rmdir(link_name)