def read_list_from_file(file_path, quiet=False):
    """
        Reads list from file. One line - one item.
        Returns the list if file items.
    """
    try:
        if not check_if_file_exists(file_path, quiet=quiet):
            return []
        with codecs.open(file_path, "r", encoding="utf-8") as f:
            content = f.readlines()
            if sys.version_info[0] < 3:
                content = [str(item.encode('utf8')) for item in content]
            content = [item.strip() for item in content]
            return [i for i in content if i]
    except Exception as exception:
        print(str(exception))
        return []