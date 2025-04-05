def valid(schema=None):
        """ Validation data by specific validictory configuration """
        def dec(fun):
            @wraps(fun)
            def d_func(self, ctx, data, *a, **kw):
                try:
                    validate(data['params'], schema)
                except ValidationError as err:
                    raise InvalidParams(err)
                except SchemaError as err:
                    raise InternalError(err)
                return fun(self, ctx, data['params'], *a, **kw)
            return d_func
        return dec