def _get(self, method, **kwargs):
        """Builds the url for the specified method and arguments and returns
        the response as a dictionary.
        """

        payload = kwargs.copy()
        payload['api_key'] = self.api_key
        payload['api_secret'] = self.api_secret

        to = payload.pop('to', None)
        if to:
            if isinstance(to, basestring):
                payload['to'] = to
            else:
                # Presumably it's a list or tuple
                for num_i, fax_num in enumerate(to):
                    payload['to[%d]' % num_i] = fax_num

        files = payload.pop('files', [])
        if not isinstance(files, (list, tuple)): files = (files,)

        req_files = {}
        for file_i, f in enumerate(files):
            if isinstance(f, basestring):
                req_files['filename[%d]' % file_i] = open(f, 'rb')
            else:
                f.seek(0)
                req_files['filename[%d]' % file_i] = f

        url = '%s/v%d/%s' % (self.BASE_URL, self.VERSION, method)

        r = requests.post(url, data=payload, files=req_files)

        return self.parse_response(r)