def parse_interfaces(interfaces):
    """
    Parse the conduit.query json dict response
    This performs the logic of parsing the non-standard params dict
        and then returning a dict Resource can understand
    """
    parsed_interfaces = collections.defaultdict(dict)

    for m, d in iteritems(interfaces):
        app, func = m.split('.', 1)

        method = parsed_interfaces[app][func] = {}

        # Make default assumptions since these aren't provided by Phab
        method['formats'] = ['json', 'human']
        method['method'] = 'POST'

        method['optional'] = {}
        method['required'] = {}

        for name, type_info in iteritems(dict(d['params'])):
            # Set the defaults
            optionality = 'required'
            param_type = 'string'

            # Usually in the format: <optionality> <param_type>
            type_info = TYPE_INFO_COMMENT_RE.sub('', type_info)
            info_pieces = TYPE_INFO_SPLITTER_RE.findall(type_info)
            for info_piece in info_pieces:
                if info_piece in ('optional', 'required'):
                    optionality = info_piece
                elif info_piece == 'ignored':
                    optionality = 'optional'
                    param_type = 'string'
                elif info_piece == 'nonempty':
                    optionality = 'required'
                elif info_piece == 'deprecated':
                    optionality = 'optional'
                else:
                    param_type = info_piece

            method[optionality][name] = map_param_type(param_type)

    return dict(parsed_interfaces)