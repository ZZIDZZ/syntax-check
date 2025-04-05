public function onResourceMaterialize(ResourceMaterializeEvent $e)
    {
        /** @var $resource MaterializedResource */
        $resource = $e->getResource();

        // Only scan resources with .css extension.
        if (preg_match('/\.css$/i', $resource->getPath())) {
            $this->scanner->scan($resource, $resource->getContent());
            $collection = $this->scanner->getQueue()->flush();
            // TODO Aggregate collection scans and materialize post hoc.
            // Materialize non-existing resources.
            foreach ($collection as $linkedResource) {
                if (!$this->mirror->exists($linkedResource)) {
                    try {
                        $this->mirror->materialize($linkedResource);
                    }
                    catch (MaterializeException $e) {}
                }
            }
        }
    }