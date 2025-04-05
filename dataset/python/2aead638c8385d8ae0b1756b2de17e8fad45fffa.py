def download_file(self, bucket, key, filename, extra_args=None,
                      callback=None):
        """Download an S3 object to a file.

        Variants have also been injected into S3 client, Bucket and Object.
        You don't have to use S3Transfer.download_file() directly.
        """
        # This method will issue a ``head_object`` request to determine
        # the size of the S3 object.  This is used to determine if the
        # object is downloaded in parallel.
        if extra_args is None:
            extra_args = {}
        self._validate_all_known_args(extra_args, self.ALLOWED_DOWNLOAD_ARGS)
        object_size = self._object_size(bucket, key, extra_args)
        temp_filename = filename + os.extsep + random_file_extension()
        try:
            self._download_file(bucket, key, temp_filename, object_size,
                                extra_args, callback)
        except Exception:
            logger.debug("Exception caught in download_file, removing partial "
                         "file: %s", temp_filename, exc_info=True)
            self._osutil.remove_file(temp_filename)
            raise
        else:
            self._osutil.rename_file(temp_filename, filename)