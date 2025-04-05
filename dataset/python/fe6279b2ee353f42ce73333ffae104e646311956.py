def print_table(language):
    '''
    Generates a formatted table of language codes
    '''
    table = translation_table(language)

    for code, name in sorted(table.items(), key=operator.itemgetter(0)):
        print(u'{language:<8} {name:\u3000<20}'.format(
            name=name, language=code
        ))

    return None