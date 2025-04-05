async def get_bots(self, limit, offset):
        '''Gets an object of bots on DBL'''
        if limit > 500:
            limit = 50
        return await self.request('GET', '{}/bots?limit={}&offset={}'.format(self.BASE, limit, offset))