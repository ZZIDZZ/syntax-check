def extract_hbs(fileobj, keywords, comment_tags, options):
    """Extract messages from Handlebars templates.

    It returns an iterator yielding tuples in the following form ``(lineno,
    funcname, message, comments)``.

    TODO: Things to improve:
    --- Return comments
    """

    server = get_pipeserver()
    server.sendline(COMMAND+u'PARSE FILE:'+fileobj.name)
    server.expect(RESPONSE+'SENDING OUTPUT')
    server.expect(RESPONSE+'OUTPUT END')
    trans_strings = server.before

    for item in json.loads(trans_strings):
        messages = [item['content']]
        if item['funcname'] == 'ngettext':
            messages.append(item['alt_content'])
        yield item['line_number'],item['funcname'],tuple(messages),[]