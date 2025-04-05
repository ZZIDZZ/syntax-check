def delete(self, k, recursive=False):
        """Delete a given key or recursively delete the tree below it"""
        k = k.lstrip('/')
        url = '{}/{}'.format(self.endpoint, k)
        params = {}
        if recursive:
            params['recurse'] = ''
        r = requests.delete(url, params=params)
        if r.status_code != 200:
            raise KVStoreError('DELETE returned {}'.format(r.status_code))