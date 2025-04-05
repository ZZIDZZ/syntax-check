def option_decorator(name, greeting, yell):
    '''Same as mix_and_match, but using the @option decorator.'''
    # Use the @option decorator when you need more control over the
    # command line options.
    say = '%s, %s' % (greeting, name)
    if yell:
        print '%s!' % say.upper()
    else:
        print '%s.' % say