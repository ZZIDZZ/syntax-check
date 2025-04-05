def adapter(data, headers, table_format=None, **kwargs):
    """Wrap terminaltables inside a function for TabularOutputFormatter."""
    keys = ('title', )

    table = table_format_handler[table_format]

    t = table([headers] + list(data), **filter_dict_by_key(kwargs, keys))

    dimensions = terminaltables.width_and_alignment.max_dimensions(
        t.table_data,
        t.padding_left,
        t.padding_right)[:3]
    for r in t.gen_table(*dimensions):
        yield u''.join(r)