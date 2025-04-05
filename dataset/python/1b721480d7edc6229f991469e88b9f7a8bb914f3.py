def get(self):
        """Check if the profiler is running."""
        self.write({"running": self.running})
        self.set_status(200)
        self.finish()