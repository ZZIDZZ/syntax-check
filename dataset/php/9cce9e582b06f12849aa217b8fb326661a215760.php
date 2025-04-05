protected function hasXMLSyntaxMarkers($content)
    {
        foreach (array('<', '&') as $char) {
            if (strpos($content, $char) !== false) {
                return true;
            }
        }

        return false;
    }