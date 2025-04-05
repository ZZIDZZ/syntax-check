public function removeUnusedNamespaces()
    {
        $nss = [];
        foreach ($this->xpathQuery('//namespace::*') as $node) {
            $namespace = $node->nodeValue;
            if (! $namespace || $this->isNameSpaceAllowed($namespace)) {
                continue;
            }
            $prefix = $this->dom->lookupPrefix($namespace);
            $nss[$prefix] = $namespace;
        }
        $nss = array_unique($nss);
        foreach ($nss as $prefix => $namespace) {
            $this->dom->documentElement->removeAttributeNS($namespace, $prefix);
        }
    }