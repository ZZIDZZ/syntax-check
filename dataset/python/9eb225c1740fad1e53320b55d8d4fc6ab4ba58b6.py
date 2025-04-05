def auth_required(realm, auth_func):
    '''Decorator that protect methods with HTTP authentication.'''
    def auth_decorator(func):
        def inner(self, *args, **kw):
            if self.get_authenticated_user(auth_func, realm):
                return func(self, *args, **kw)
        return inner
    return auth_decorator