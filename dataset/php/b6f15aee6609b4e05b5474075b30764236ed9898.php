public function addChild($child): AbstractElement
    {
        if ($child instanceof PhpMethod) {
            $child->setHasBody(false);
        }
        return parent::addChild($child);
    }