public function remove($object_id, $tag, $object_type = 'Ticket')
    {
        $this->clearError();

        if ( empty($object_id) ) {
            throw new \RuntimeException('Missing object ID');
        }

        if ( empty($tag) ) {
            throw new \RuntimeException('Missing tag');
        }

        // Delete object in Zammad.
        $response = $this->getClient()->get(
            $this->getURL('remove'),
            [
                'object' => $object_type,
                'o_id'   => $object_id,
                'item'   => $tag,
            ]
        );

        if ( $response->hasError() ) {
            $this->setError( $response->getError() );
            return $this;
        }

        // Clear data of this (local) object.
        $this->clearError();
        $this->clearRemoteData();
        $this->clearUnsavedValues();

        return $this;
    }