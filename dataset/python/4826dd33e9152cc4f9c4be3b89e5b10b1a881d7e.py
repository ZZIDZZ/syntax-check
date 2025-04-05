def fix_version(context):
    """Fix the version in metadata.txt

    Relevant context dict item for both prerelease and postrelease:
    ``new_version``.

    """
    if not prerequisites_ok():
        return
    lines = codecs.open('metadata.txt', 'rU', 'utf-8').readlines()
    for index, line in enumerate(lines):
        if line.startswith('version'):
            new_line = 'version=%s\n' % context['new_version']
            lines[index] = new_line
    time.sleep(1)
    codecs.open('metadata.txt', 'w', 'utf-8').writelines(lines)