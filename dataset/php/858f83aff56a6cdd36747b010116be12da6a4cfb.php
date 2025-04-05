private function getAttribute(\DOMNode $domNode, string $name): ?string
    {
        if (!\count($domNode->attributes)) {
            return null;
        }

        /** @var \DOMAttr $attribute */
        foreach ($domNode->attributes as $attribute) {
            if ($attribute->name === $name) {
                return $attribute->value;
            }
        }

        return null;
    }