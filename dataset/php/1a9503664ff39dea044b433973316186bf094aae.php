protected function indentRecursive(\DOMNode $currentNode, $depth) {
        $indent_characters = $this->options['indent_characters'];

        $indentCurrent = true;
        $indentChildren = true;
        $indentClosingTag = false;
        if(($currentNode->nodeType == XML_TEXT_NODE)) {
            $indentCurrent = false;
        }

        if (in_array($currentNode->nodeName, $this->options['keep_whitespace_in'])) {
            $indentCurrent = true;
            $indentChildren = false;
            $indentClosingTag = (strpos($currentNode->nodeValue, "\n") !== false);
        }

        if (in_array($currentNode->nodeName, $this->options['keep_whitespace_around'])) {
            $indentCurrent = false;
        }
        if($indentCurrent && $depth > 0) {
            // Indenting a node consists of inserting before it a new text node
            // containing a newline followed by a number of tabs corresponding
            // to the node depth.
            $textNode = $currentNode->ownerDocument->createTextNode("\n" . str_repeat($indent_characters, $depth));
            $currentNode->parentNode->insertBefore($textNode, $currentNode);
        }
        if($indentCurrent && $currentNode->childNodes && $indentChildren) {
            foreach($currentNode->childNodes as $childNode) {
                $indentClosingTag = $this->indentRecursive($childNode, $depth + 1);
            }
        }
        if($indentClosingTag) {
            // If children have been indented, then the closing tag
            // of the current node must also be indented.
            if ($currentNode->lastChild && ($currentNode->lastChild->nodeType == XML_CDATA_SECTION_NODE || $currentNode->lastChild->nodeType == XML_TEXT_NODE) && preg_match('/\n\s?$/', $currentNode->lastChild->textContent)) {
                $currentNode->lastChild->nodeValue = preg_replace('/\n\s?$/', "\n" . str_repeat("\t", $depth), $currentNode->lastChild->nodeValue);
            } else {
                $textNode = $currentNode->ownerDocument->createTextNode("\n" . str_repeat("\t", $depth));
                $currentNode->appendChild($textNode);
            }
        }
        return $indentCurrent;
    }