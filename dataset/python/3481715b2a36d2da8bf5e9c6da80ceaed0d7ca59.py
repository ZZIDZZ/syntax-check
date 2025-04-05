def call(self, url, method=None, args=None):
        """Calls the first function matching the urls pattern and method.

        Args:
            url (str): Url for which to call a matching function.
            method (str, optional): The method used while registering a
                function.
                Defaults to None
            args (dict, optional): Additional args to be passed to the
                matching function.

        Returns:
            The functions return value or `None` if no function was called.
        """
        if not args:
            args = {}

        if sys.version_info.major == 3:
            data = urllib.parse.urlparse(url)
            path = data.path.rstrip('/') + '/'
            _args = dict(urllib.parse.parse_qs(data.query,
                                               keep_blank_values=True))
        elif sys.version_info.major == 2:
            data = urlparse.urlparse(url)
            path = data.path.rstrip('/') + '/'
            _args = dict(urlparse.parse_qs(data.query,
                                           keep_blank_values=True))

        for elem in self._data_store:
            pattern = elem['pattern']
            function = elem['function']
            _method = elem['method']
            type_cast = elem['type_cast']

            result = re.match(pattern, path)

            # Found matching method
            if result and _method == method:
                _args = dict(_args, **result.groupdict())

                # Unpack value lists (due to urllib.parse.parse_qs) in case
                # theres only one value available
                for key, val in _args.items():
                    if isinstance(_args[key], list) and len(_args[key]) == 1:
                        _args[key] = _args[key][0]

                # Apply typ-casting if necessary
                for key, val in type_cast.items():

                    # Not within available _args, no type-cast required
                    if key not in _args:
                        continue

                    # Is None or empty, no type-cast required
                    if not _args[key]:
                        continue

                    # Try and cast the values
                    if isinstance(_args[key], list):
                        for i, _val in enumerate(_args[key]):
                            _args[key][i] = self._cast(_val, val)
                    else:
                        _args[key] = self._cast(_args[key], val)

                requiered_args = self._get_function_args(function)
                for key, val in args.items():
                    if key in requiered_args:
                        _args[key] = val

                return function(**_args)

        return None