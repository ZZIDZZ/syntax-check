def  make_file_list( args = None ):
    """builds a list of input files from command-line arguments"""
    file_list = []
    # sys.stderr.write( repr( sys.argv[1 :] ) + '\n' )

    if not args:
        args = sys.argv[1 :]

    for pathname in args:
        if string.find( pathname, '*' ) >= 0:
            newpath = glob.glob( pathname )
            newpath.sort()  # sort files -- this is important because
                            # of the order of files
        else:
            newpath = [pathname]

        file_list.extend( newpath )

    if len( file_list ) == 0:
        file_list = None
    else:
        # now filter the file list to remove non-existing ones
        file_list = filter( file_exists, file_list )

    return file_list