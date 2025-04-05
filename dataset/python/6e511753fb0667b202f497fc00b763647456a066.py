def themes_path():
    """
    Retrieve the location of the themes directory from the location of this package

    This is taken from Sphinx's theme documentation
    """
    package_dir = os.path.abspath(os.path.dirname(__file__))
    return os.path.join(package_dir, 'themes')