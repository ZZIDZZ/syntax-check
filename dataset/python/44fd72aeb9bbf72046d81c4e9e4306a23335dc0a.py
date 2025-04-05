def restore(folder):
    "Restore a project from the archive."
    if os.path.isdir(folder):
        bail('a folder of the same name already exists!')

    pattern = os.path.join(PROJ_ARCHIVE, '*', '*', folder)
    matches = glob.glob(pattern)
    if not matches:
        bail('no project matches: ' + folder)

    if len(matches) > 1:
        print('Warning: multiple matches, picking the most recent',
              file=sys.stderr)

    source = sorted(matches)[-1]
    print(source, '-->', folder)
    shutil.move(source, '.')