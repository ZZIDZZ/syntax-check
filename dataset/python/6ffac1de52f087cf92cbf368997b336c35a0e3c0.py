def sync_folder(self, path, bucket):
        """Syncs a local directory with an S3 bucket.
     
        Currently does not delete files from S3 that are not in the local directory.

        path: The path to the directory to sync to S3
        bucket: The name of the bucket on S3
        """
        bucket = self.conn.get_bucket(bucket)
        local_files = self._get_local_files(path)
        s3_files = self._get_s3_files(bucket)
        for filename, hash in local_files.iteritems():
            s3_key = s3_files[filename]
            if s3_key is None:
                s3_key = Key(bucket)
                s3_key.key = filename
                s3_key.etag = '"!"'
            
            if s3_key.etag[1:-1] != hash[0]:
                s3_key.set_contents_from_filename(join(path, filename), md5=hash)