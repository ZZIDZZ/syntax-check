def factory(cls, filename, mode, on_close):
        """Create a S3File backed with a temporary file."""
        _temp_file = tempfile.TemporaryFile()
        proxy = cls(_temp_file, filename, mode, on_close=on_close)
        return proxy