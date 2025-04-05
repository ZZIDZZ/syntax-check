public function writeAttribute($name, $value): bool
    {
        if ('{' !== $name[0]) {
            return parent::writeAttribute($name, $value);
        }

        list(
            $namespace,
            $localName
        ) = Service::parseClarkNotation($name);

        if (array_key_exists($namespace, $this->namespaceMap)) {
            // It's an attribute with a namespace we know
            return $this->writeAttribute(
                $this->namespaceMap[$namespace].':'.$localName,
                $value
            );
        }

        // We don't know the namespace, we must add it in-line
        if (!isset($this->adhocNamespaces[$namespace])) {
            $this->adhocNamespaces[$namespace] = 'x'.(count($this->adhocNamespaces) + 1);
        }

        return $this->writeAttributeNS(
            $this->adhocNamespaces[$namespace],
            $localName,
            $namespace,
            $value
        );
    }