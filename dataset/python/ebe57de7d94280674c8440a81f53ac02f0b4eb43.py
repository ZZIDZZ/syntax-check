def _get_request(self, endpoint):
        """Do actual GET request to GC REST API
        Also validates responses.

        Keyword arguments:
        endpoint -- full endpoint for GET request
        """
        try:
            response = requests.get(endpoint)
        except requests.exceptions.RequestException:
            raise GoldenCheetahNotAvailable(endpoint)
        
        if response.text.startswith('unknown athlete'):
            match = re.match(
                pattern='unknown athlete (?P<athlete>.+)',
                string=response.text)
            raise AthleteDoesNotExist(
                athlete=match.groupdict()['athlete'])

        elif response.text == 'file not found':
            match = re.match(
                pattern='.+/activity/(?P<filename>.+)',
                string=endpoint)
            raise ActivityDoesNotExist(
                filename=match.groupdict()['filename'])

        return response