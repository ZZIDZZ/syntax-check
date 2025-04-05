def file_key(filename):
    '''Sort keys for xpi files

    The filenames in a manifest are ordered so that files not in a
    directory come before files in any directory, ordered
    alphabetically but ignoring case, with a few exceptions
    (install.rdf, chrome.manifest, icon.png and icon64.png come at the
    beginning; licenses come at the end).

    This order does not appear to affect anything in any way, but it
    looks nicer.
    '''
    prio = 4
    if filename == 'install.rdf':
        prio = 1
    elif filename in ["chrome.manifest", "icon.png", "icon64.png"]:
        prio = 2
    elif filename in ["MPL", "GPL", "LGPL", "COPYING",
                      "LICENSE", "license.txt"]:
        prio = 5
    return (prio, os.path.split(filename.lower()))