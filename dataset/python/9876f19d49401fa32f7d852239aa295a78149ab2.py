def init(
    dist='dist',
    minver=None,
    maxver=None,
    use_markdown_readme=True,
    use_stdeb=False,
    use_distribute=False,
    ):
    """Imports and returns a setup function.

    If use_markdown_readme is set,
    then README.md is added to setuptools READMES list.

    If use_stdeb is set on a Debian based system,
    then module stdeb is imported.
    Stdeb supports building deb packages on Debian based systems.
    The package should only be installed on the same system version
    it was built on, though. See http://github.com/astraw/stdeb.

    If use_distribute is set, then distribute_setup.py is imported.
    """
    if not minver == maxver == None:
        import sys
        if not minver <= sys.version < (maxver or 'Any'):
            sys.stderr.write(
                '%s: requires python version in <%s, %s), not %s\n' % (
                sys.argv[0], minver or 'any', maxver or 'any', sys.version.split()[0]))
            sys.exit(1)

    if use_distribute:
        from distribute_setup import use_setuptools
        use_setuptools(to_dir=dist)
        from setuptools import setup
    else:
        try:
            from setuptools import setup
        except ImportError:
            from distutils.core import setup

    if use_markdown_readme:
        try:
            import setuptools.command.sdist
            setuptools.command.sdist.READMES = tuple(list(getattr(setuptools.command.sdist, 'READMES', ()))
                + ['README.md'])
        except ImportError:
            pass

    if use_stdeb:
        import platform
        if 'debian' in platform.dist():
            try:
                import stdeb
            except ImportError:
                pass

    return setup