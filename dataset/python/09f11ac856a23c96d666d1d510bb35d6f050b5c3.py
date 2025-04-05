def _kwargs_to_qs(**kwargs):
    """Converts kwargs given to PSF to a querystring.

    :returns: the querystring.
    """
    # start with defaults
    inpOptDef = inputs_options_defaults()
    opts = {
        name: dct['value']
        for name, dct in inpOptDef.items()
    }

    # clean up keys and values
    for k, v in kwargs.items():
        del kwargs[k]
        # bool => 'Y'|'N'
        if isinstance(v, bool):
            kwargs[k] = 'Y' if v else 'N'
        # tm, team => team_id
        elif k.lower() in ('tm', 'team'):
            kwargs['team_id'] = v
        # yr, year, yrs, years => year_min, year_max
        elif k.lower() in ('yr', 'year', 'yrs', 'years'):
            if isinstance(v, collections.Iterable):
                lst = list(v)
                kwargs['year_min'] = min(lst)
                kwargs['year_max'] = max(lst)
            elif isinstance(v, basestring):
                v = list(map(int, v.split(',')))
                kwargs['year_min'] = min(v)
                kwargs['year_max'] = max(v)
            else:
                kwargs['year_min'] = v
                kwargs['year_max'] = v
        # pos, position, positions => pos[]
        elif k.lower() in ('pos', 'position', 'positions'):
            if isinstance(v, basestring):
                v = v.split(',')
            elif not isinstance(v, collections.Iterable):
                v = [v]
            kwargs['pos[]'] = v
        # draft_pos, ... => draft_pos[]
        elif k.lower() in (
            'draft_pos', 'draftpos', 'draftposition', 'draftpositions',
            'draft_position', 'draft_positions'
        ):
            if isinstance(v, basestring):
                v = v.split(',')
            elif not isinstance(v, collections.Iterable):
                v = [v]
            kwargs['draft_pos[]'] = v
        # if not one of these cases, put it back in kwargs
        else:
            kwargs[k] = v

    # update based on kwargs
    for k, v in kwargs.items():
        # if overwriting a default, overwrite it (with a list so the
        # opts -> querystring list comp works)
        if k in opts or k in ('pos[]', 'draft_pos[]'):
            # if multiple values separated by commas, split em
            if isinstance(v, basestring):
                v = v.split(',')
            # otherwise, make sure it's a list
            elif not isinstance(v, collections.Iterable):
                v = [v]
            # then, add list of values to the querystring dict *opts*
            opts[k] = v
        if 'draft' in k:
            opts['draft'] = [1]

    opts['request'] = [1]
    opts['offset'] = [kwargs.get('offset', 0)]

    qs = '&'.join(
        '{}={}'.format(urllib.parse.quote_plus(name), val)
        for name, vals in sorted(opts.items()) for val in vals
    )

    return qs