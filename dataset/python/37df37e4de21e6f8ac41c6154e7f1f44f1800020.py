def get_deployments(self, prefix=""):
        """ This endpoint lists all deployments.

           https://www.nomadproject.io/docs/http/deployments.html

            optional_arguments:
              - prefix, (default "") Specifies a string to filter deployments on based on an index prefix.
                        This is specified as a querystring parameter.

            returns: list of dicts
            raises:
              - nomad.api.exceptions.BaseNomadException
              - nomad.api.exceptions.URLNotFoundNomadException
        """
        params = {"prefix": prefix}
        return self.request(params=params, method="get").json()