private function translateParams(ReplaceInsertTagsEvent $event)
    {
        $infinite    = false;
        $columnSetId = $event->getParam(0);

        if ($event->getParam(1) === 'begin' && $event->getParam(2)) {
            $columnSetId = $event->getParam(2);

            if ($event->getParam(3)) {
                $infinite = true;
            }
        }

        return array($columnSetId, $infinite);
    }