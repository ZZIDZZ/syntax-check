def outfile_input(extension=None):
    """Get an output file name as input"""
    
    fileok = False
    
    while not fileok:
        filename = string_input('File name? ')
        if extension:
            if not filename.endswith(extension):
                if extension.startswith('.'):
                    filename = filename + extension
                else:
                    filename = filename + '.' + extension
        if os.path.isfile(filename):
            choice = choice_input(prompt=filename + \
                    ' already exists. Overwrite?',
                    options=['y', 'n'])
            if choice == 'y':
                try:
                    nowtime = time.time()
                    with open(filename, 'a') as f:
                        os.utime(filename, (nowtime, nowtime))
                    fileok = True
                except IOError:
                    print('Write permission denied on ' + filename + \
                            '. Try again.')
                except PermissionError:
                    print('Write permission denied on ' + filename + \
                            '. Try again.')
                except FileNotFoundError:
                    print(filename + ': directory not found. Try again.')

        else:
            choice = choice_input(
                    prompt=filename + ' does not exist. Create it?',
                    options=['y', 'n'])
            if choice == 'y':
                try:
                    nowtime = time.time()
                    with open(filename, 'w') as f:
                        os.utime(filename, (nowtime, nowtime))
                    fileok = True
                except IOError:
                    print('Write permission denied on ' + filename + \
                            '. Try again.')
                except PermissionError:
                    print('Write permission denied on ' + filename + \
                            '. Try again.')
                except FileNotFoundError:
                    print(filename + ': directory not found. Try again.')

    return filename