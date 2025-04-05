protected function getLinksFromDataArray(array $linksArray)
    {
        $links = array();
        foreach ($linksArray as $linkArray) {
            $link = new Link();

            if (isset($linkArray['rel']) && is_array($linkArray['rel'])) {
                $link->setRel($linkArray['rel']);
            }

            if (isset($linkArray['href']) && is_string($linkArray['href'])) {
                $link->setHref($linkArray['href']);
            }

            $links[] = $link;
        }

        return $links;
    }