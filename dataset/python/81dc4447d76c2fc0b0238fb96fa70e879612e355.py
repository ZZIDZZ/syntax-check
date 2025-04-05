def _find_by_path_s3(self, path, bucket_name):
        """Finds files by licking an S3 bucket's contents by prefix."""

        conn = S3Connection(self.access_key_id, self.access_key_secret)
        bucket = conn.get_bucket(bucket_name)

        s3_path = self._get_s3_path(path)

        return bucket.list(prefix=s3_path)