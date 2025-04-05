def modify_conf():
    """
    pip install redbaron
    """
    import redbaron
    import ubelt as ub
    conf_path = 'docs/conf.py'

    source = ub.readfrom(conf_path)
    red = redbaron.RedBaron(source)

    # Insert custom extensions
    extra_extensions = [
        '"sphinxcontrib.napoleon"'
    ]

    ext_node = red.find('name', value='extensions').parent
    ext_node.value.value.extend(extra_extensions)

    # Overwrite theme to read-the-docs
    theme_node = red.find('name', value='html_theme').parent
    theme_node.value.value = '"sphinx_rtd_theme"'

    ub.writeto(conf_path, red.dumps())