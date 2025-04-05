def stop(self, now=False):
        """Stop and remove the service

        Consider using stop/start when Docker adds support
        """
        self.log.info(
            "Stopping and removing Docker service %s (id: %s)",
            self.service_name, self.service_id[:7])
        yield self.docker('remove_service', self.service_id[:7])
        self.log.info(
            "Docker service %s (id: %s) removed",
            self.service_name, self.service_id[:7])

        self.clear_state()