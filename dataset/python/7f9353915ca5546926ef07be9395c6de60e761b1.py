def running_conversions(self, folder_id=None):
        """Shows running file converts by folder

        Note:
            If folder_id is not provided, ``Home`` folder will be used.

        Args:
            folder_id (:obj:`str`, optional): id of the folder to list conversions of files exist in it.

        Returns:
            list: list of dictionaries, each dictionary represents a file conversion info. ::

                      [
                        {
                          "name": "Geysir.AVI",
                          "id": "3565411",
                          "status": "pending",
                          "last_update": "2015-08-23 19:41:40",
                          "progress": 0.32,
                          "retries": "0",
                          "link": "https://openload.co/f/f02JFG293J8/Geysir.AVI",
                          "linkextid": "f02JFG293J8"
                        },
                        ....
                      ]

        """
        params = {'folder': folder_id} if folder_id else {}
        return self._get('file/runningconverts', params=params)