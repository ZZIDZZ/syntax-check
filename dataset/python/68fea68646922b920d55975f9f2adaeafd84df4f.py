def _main(argv, standard_out, standard_error):
    """Return exit status.

    0 means no error.
    """
    import argparse
    parser = argparse.ArgumentParser(description=__doc__, prog='autoflake')
    parser.add_argument('-c', '--check', action='store_true',
                        help='return error code if changes are needed')
    parser.add_argument('-i', '--in-place', action='store_true',
                        help='make changes to files instead of printing diffs')
    parser.add_argument('-r', '--recursive', action='store_true',
                        help='drill down directories recursively')
    parser.add_argument('--exclude', metavar='globs',
                        help='exclude file/directory names that match these '
                             'comma-separated globs')
    parser.add_argument('--imports',
                        help='by default, only unused standard library '
                             'imports are removed; specify a comma-separated '
                             'list of additional modules/packages')
    parser.add_argument('--expand-star-imports', action='store_true',
                        help='expand wildcard star imports with undefined '
                             'names; this only triggers if there is only '
                             'one star import in the file; this is skipped if '
                             'there are any uses of `__all__` or `del` in the '
                             'file')
    parser.add_argument('--remove-all-unused-imports', action='store_true',
                        help='remove all unused imports (not just those from '
                             'the standard library)')
    parser.add_argument('--ignore-init-module-imports', action='store_true',
                        help='exclude __init__.py when removing unused '
                             'imports')
    parser.add_argument('--remove-duplicate-keys', action='store_true',
                        help='remove all duplicate keys in objects')
    parser.add_argument('--remove-unused-variables', action='store_true',
                        help='remove unused variables')
    parser.add_argument('--version', action='version',
                        version='%(prog)s ' + __version__)
    parser.add_argument('files', nargs='+', help='files to format')

    args = parser.parse_args(argv[1:])

    if args.remove_all_unused_imports and args.imports:
        print('Using both --remove-all and --imports is redundant',
              file=standard_error)
        return 1

    if args.exclude:
        args.exclude = _split_comma_separated(args.exclude)
    else:
        args.exclude = set([])

    filenames = list(set(args.files))
    failure = False
    for name in find_files(filenames, args.recursive, args.exclude):
        try:
            fix_file(name, args=args, standard_out=standard_out)
        except IOError as exception:
            print(unicode(exception), file=standard_error)
            failure = True

    return 1 if failure else 0