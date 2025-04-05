def get_asset(self, symbol):
        '''Get an asset'''
        resp = self.get('/assets/{}'.format(symbol))
        return Asset(resp)