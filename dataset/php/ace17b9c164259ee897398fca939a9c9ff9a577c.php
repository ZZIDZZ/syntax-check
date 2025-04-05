public function reverseTransform($value)
    {
        if (is_null($value))
        {
            return null;
        }

        $dir = $this->objectManager->getRepository('CoreBundle:Directory')
            ->find($value);
        if ($dir === null)
        {
            throw new TransformationFailedException("The directory was not found!");
        }
        return $dir;
    }