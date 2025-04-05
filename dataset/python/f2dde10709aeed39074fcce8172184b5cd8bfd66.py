def plot(parser, token):
    """
    Tag to plot graphs into the template
    """

    tokens = token.split_contents()
    tokens.pop(0)
    graph = tokens.pop(0)

    attrs = dict([token.split("=") for token in tokens])

    if 'id' not in attrs.keys():
        attrs['id'] = ''.join([chr(choice(range(65, 90))) for i in range(0, 5)])
    else:
        attrs['id'] = attrs['id'][1:len(attrs['id'])-1]

    attr_string = ''.join([" %s=%s" % (k, v) for k, v in attrs.iteritems()])
    return GraphRenderer(graph, attr_string, attrs['id'])