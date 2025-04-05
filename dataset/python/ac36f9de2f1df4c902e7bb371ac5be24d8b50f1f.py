def to_representation(self, value):
        """
        Perform the actual serialization.

        Args:
            value: the image to transform
        Returns:
            a url pointing at a scaled and cached image
        """
        if not value:
            return None

        image = get_thumbnail(value, self.geometry_string, **self.options)

        try:
            request = self.context.get('request', None)
            return request.build_absolute_uri(image.url)
        except:
            try:
                return super(HyperlinkedSorlImageField, self).to_representation(image)
            except AttributeError:  # NOQA
                return super(HyperlinkedSorlImageField, self).to_native(image.url)  # NOQA