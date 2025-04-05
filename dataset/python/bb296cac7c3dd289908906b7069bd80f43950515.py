async def from_href(self):
        """Get the full object from spotify with a `href` attribute."""
        if not hasattr(self, 'href'):
            raise TypeError('Spotify object has no `href` attribute, therefore cannot be retrived')

        elif hasattr(self, 'http'):
            return await self.http.request(('GET', self.href))

        else:
            cls = type(self)

        try:
            client = getattr(self, '_{0}__client'.format(cls.__name__))
        except AttributeError:
            raise TypeError('Spotify object has no way to access a HTTPClient.')
        else:
            http = client.http

        data = await http.request(('GET', self.href))

        return cls(client, data)