def configure_analytics_yandex(self, ident, params=None):
        """Configure Yandex Metrika analytics counter.

        :param str|unicode ident: Metrika counter ID.

        :param dict params: Additional params.

        """
        params = params or {}

        data = {
            'type': 'Yandex',
            'id': ident,
        }

        if params:
            data['params'] = '%s' % params

        self.analytics.append(data)