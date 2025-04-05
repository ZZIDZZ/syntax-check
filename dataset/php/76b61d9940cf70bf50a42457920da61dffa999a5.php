public function handleSlug(HTTPRequest $request)
    {
        $item = $this->findSlug();
        if (!$item) {
            $owner = $this->getOwner();
            $owner->httpError(404);
        }
        $item->setSlugActive(Slug::ACTIVE_CURRENT);
        return ['ActiveSlug' => $item];
    }