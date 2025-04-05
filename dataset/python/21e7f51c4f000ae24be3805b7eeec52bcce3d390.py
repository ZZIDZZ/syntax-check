def upload(self, tags, file_path, username=None):
        """
        Uploads a gif from the filesystem to Giphy.

        :param tags: Tags to apply to the uploaded image
        :type tags: list
        :param file_path: Path at which the image can be found
        :type file_path: string
        :param username: Your channel username if not using public API key
        """
        params = {
            'api_key': self.api_key,
            'tags': ','.join(tags)
        }
        if username is not None:
            params['username'] = username

        with open(file_path, 'rb') as f:
            resp = requests.post(
                GIPHY_UPLOAD_ENDPOINT, params=params, files={'file': f})

        resp.raise_for_status()

        data = resp.json()
        self._check_or_raise(data.get('meta', {}))

        return self.gif(data['data']['id'])