def results(self):
        """
        The pods that hold the response to a simple, discrete query.
        """
        return (
            pod
            for pod in self.pods
            if pod.primary
            or pod.title == 'Result'
        )