def execute(self, override_wf_json=None):
        """
        Execute the cloud_harness task.
        """
        r = self.gbdx.post(
            self.URL,
            json=self.json if override_wf_json is None else override_wf_json
        )

        try:
            r.raise_for_status()
        except:
            print("GBDX API Status Code: %s" % r.status_code)
            print("GBDX API Response: %s" % r.text)
            self.id = None
            return

        self.id = r.json()['id']
        self._refresh_status()