def parse_args_kwargs(parser, token):
    """
    Parse uniformly args and kwargs from a templatetag

    Usage::

      For parsing a template like this:

      {% footag my_contents,height=10,zoom=20 as myvar %}

      You simply do this:

      @register.tag
      def footag(parser, token):
          args, kwargs = parse_args_kwargs(parser, token)
    """
    bits = token.contents.split(' ')

    if len(bits) <= 1:
        raise template.TemplateSyntaxError("'%s' takes at least one argument" % bits[0])

    if token.contents[13] == '"':
        end_quote = token.contents.index('"', 14) + 1
        args = [template.Variable(token.contents[13:end_quote])]
        kwargs_start = end_quote
    else:
        try:
            next_space = token.contents.index(' ', 14)
            kwargs_start = next_space + 1
        except ValueError:
            next_space = None
            kwargs_start = None
        args = [template.Variable(token.contents[13:next_space])]

    kwargs = {}
    kwargs_list = token.contents[kwargs_start:].split(',')
    for kwargs_item in kwargs_list:
        if '=' in kwargs_item:
            k, v = kwargs_item.split('=', 1)
            k = k.strip()
            kwargs[k] = template.Variable(v)
    return args, kwargs