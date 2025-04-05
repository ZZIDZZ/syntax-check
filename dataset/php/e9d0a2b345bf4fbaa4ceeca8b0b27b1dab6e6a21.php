public function setBucket(BucketInterface $bucket = null)
    {
        if ($bucket) {
            $this->bucket = $bucket;
            $this->logger->debug('Swivel - User bucket set.', compact('bucket'));
        }

        return $this;
    }