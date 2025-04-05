def version_number_str(major, minor=0, patch=0, prerelease=None, build=None):
    """
    Takes the parts of a semantic version number, and returns a nicely
    formatted string.
    """
    version = str(major) + '.' + str(minor) + '.' + str(patch)
    if prerelease:
        if prerelease.startswith('-'):
            version = version + prerelease
        else:
            version = version + "-" + str(prerelease)
    if build:
        if build.startswith('+'):
            version = version + build
        else:
            version = version + "+" + str(build)
    return(version)