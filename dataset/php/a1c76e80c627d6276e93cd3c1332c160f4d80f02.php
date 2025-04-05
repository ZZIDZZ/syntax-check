protected function getManager()
    {
        $gdm = $this->get('wobblecode_manager.document_manager')
                    ->setDocument('WobbleCodeUserBundle:Organization')
                    ->setKey('organization')
                    ->setAcceptFromRequest(['page', 'query', 'itemsPerPage'])
                    ->setItemsPerPage(2)
                    ->setQueryFields(['name', 'type']);

        return $gdm;
    }