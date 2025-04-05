public function hasLayout()
    {
        $masterRequest = $this->requestStack->getMasterRequest();
        $currentRequest = $this->requestStack->getCurrentRequest();

        if (
            $masterRequest->isXmlHttpRequest()
            || 'off' === $masterRequest->get('_layout')
            || (
                $currentRequest !== $masterRequest
                && !$currentRequest->attributes->has('exception')
                && !$currentRequest->attributes->get('_layout', false)
            )
        ) {
            return false;
        }
        return true;
    }