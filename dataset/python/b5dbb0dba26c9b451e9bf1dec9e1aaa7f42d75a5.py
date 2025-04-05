def prepare_post_parameters(self, post_params=None, files=None):
        """
        Builds form parameters.

        :param post_params: Normal form parameters.
        :param files: File parameters.
        :return: Form parameters with files.
        """
        params = {}

        if post_params:
            params.update(post_params)

        if files:
            for k, v in iteritems(files):
                if not v:
                    continue

                with open(v, 'rb') as f:
                    filename = os.path.basename(f.name)
                    filedata = f.read()
                    mimetype = mimetypes.\
                        guess_type(filename)[0] or 'application/octet-stream'
                    params[k] = tuple([filename, filedata, mimetype])

        return params