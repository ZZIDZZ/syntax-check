def connect_earthexplorer(self):
        """   Connection to Earth explorer without proxy  """
        logger.info("Establishing connection to Earthexplorer")
        print("\n Establishing connection to Earthexplorer")
        try:
            opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor())
            urllib.request.install_opener(opener)
            params = urllib.parse.urlencode(dict(username=self.user, password=self.password))
            params = params.encode('utf-8')
            f = opener.open("https://ers.cr.usgs.gov/login", params)
            data = f.read().decode('utf-8')
            f.close()
            if data.find(
                    'You must sign in as a registered user to download data or place orders for USGS EROS products') > 0:
                print("\n Authentification failed")
                logger.error("Authentification failed")
                raise AutenticationUSGSFailed('Authentification USGS failed')
            print('User %s connected with USGS' % self.user)
            logger.debug('User %s connected with USGS' % self.user)
            return
        except Exception as e:
            print('\nError when trying to connect USGS: %s' % e)
            raise logger.error('Error when trying to connect USGS: %s' % e)