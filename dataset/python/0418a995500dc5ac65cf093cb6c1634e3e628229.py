def fancy_tag_compiler(params, defaults, takes_var_args, takes_var_kwargs, takes_context, name, node_class, parser, token):
    "Returns a template.Node subclass."
    bits = token.split_contents()[1:]

    if takes_context:
        if 'context' in params[:1]:
            params = params[1:]
        else:
            raise TemplateSyntaxError(
                "Any tag function decorated with takes_context=True "
                "must have a first argument of 'context'")

    # Split args and kwargs
    args = []
    kwargs = {}
    kwarg_found = False
    unhandled_params = list(params)
    handled_params = []
    if len(bits) > 1 and bits[-2] == 'as':
        output_var = bits[-1]
        if len(set(output_var) - set(ALLOWED_VARIABLE_CHARS)) > 0:
            raise TemplateSyntaxError("%s got output var name with forbidden chars: '%s'" % (name, output_var))
        bits = bits[:-2]
    else:
        output_var = None
    for bit in bits:
        kwarg_match = kwarg_re.match(bit)
        if kwarg_match:
            kw, var = kwarg_match.groups()
            if kw not in params and not takes_var_kwargs:
                raise TemplateSyntaxError("%s got unknown keyword argument '%s'" % (name, kw))
            elif kw in handled_params:
                raise TemplateSyntaxError("%s got multiple values for keyword argument '%s'" % (name, kw))
            else:
                kwargs[str(kw)] = var
                kwarg_found = True
                handled_params.append(kw)
        else:
            if kwarg_found:
                raise TemplateSyntaxError("%s got non-keyword arg after keyword arg" % name)
            else:
                args.append(bit)
                try:
                    handled_params.append(unhandled_params.pop(0))
                except IndexError:
                    if not takes_var_args:
                        raise TemplateSyntaxError("%s got too many arguments" % name)
    # Consider the last n params handled, where n is the number of defaults.
    if defaults is not None:
        unhandled_params = unhandled_params[:-len(defaults)]
    if len(unhandled_params) == 1:
        raise TemplateSyntaxError("%s didn't get a value for argument '%s'" % (name, unhandled_params[0]))
    elif len(unhandled_params) > 1:
        raise TemplateSyntaxError("%s didn't get values for arguments: %s" % (
                name, ', '.join(["'%s'" % p for p in unhandled_params])))

    return node_class(args, kwargs, output_var, takes_context)