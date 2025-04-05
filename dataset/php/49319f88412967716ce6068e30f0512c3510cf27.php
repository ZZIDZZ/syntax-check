public static function getStateDocument(DocumentData $documentData = null)
    {
        if (null === $documentData) {
            $documentData = static::getDocumentData();
        }

        $agent = new Agent(InverseFunctionalIdentifier::withMbox(IRI::fromString('mailto:alice@example.com')));
        $activity = new Activity(IRI::fromString('activity-id'));

        return new StateDocument(new State($activity, $agent, 'state-id'), $documentData);
    }