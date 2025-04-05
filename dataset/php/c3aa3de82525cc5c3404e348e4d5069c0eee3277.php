public function loadFromXML($xml)
    {

        // root
        $dom = new \DOMDocument();
        $dom->loadXML($xml);

        // collections
        $collElems = $dom->getElementsByTagName('collections')->item(0)->getElementsByTagName('collection');
        foreach ($collElems as $elem) {
            if($elem->nodeType === XML_ELEMENT_NODE) {
                $this->addCollections($elem->nodeValue);
            }
        }

        // permissions
        $permElems = $dom->getElementsByTagName('permissions')->item(0)->getElementsByTagName('permission');
        $permissions = array();
        foreach($permElems as $elem) {
            if($elem->nodeType === XML_ELEMENT_NODE) {
                $role_name = $elem->getElementsByTagName('role-name')->item(0)->nodeValue;
                $capElems = $elem->getElementsByTagName('capability');
                $capabilities = array();
                foreach($capElems as $c) {
                    $capabilities[] = $c->nodeValue;
                }
                $permission = new Permission($role_name, $capabilities);
                $permissions[] = $permission;
            }
        }
        $this->addPermissions($permissions);

        // properties
        $propElems = $dom->getElementsByTagName('properties')->item(0)->childNodes;
        foreach($propElems as $elem) {
            if($elem->nodeType === XML_ELEMENT_NODE) {
                $this->addProperties(array($elem->tagName => $elem->nodeValue));
            }
        }

        // quality
        $qElem = $dom->getElementsByTagName('quality')->item(0);
        $this->setQuality($qElem->nodeValue);

        return $this;
    }