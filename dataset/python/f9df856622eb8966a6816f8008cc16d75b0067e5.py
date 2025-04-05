def _transform_data(data: dict) -> dict:
        """
        Each CloudStack API call returns a nested dictionary structure. The first level contains only one key indicating
        the API that originated the response. This function removes that first level from the data returned to the
        caller.

        :param data: Response of the API call
        :type data: dict
        :return: Simplified response without the information about the API that originated the response.
        :rtype: dict
        """
        for key in data.keys():
            return_value = data[key]
            if isinstance(return_value, dict):
                return return_value
        return data