public function linesToChars($text1, $text2)
    {
        // e.g. $lineArray[4] == "Hello\n"
        $lineArray = array();
        // e.g. $lineHash["Hello\n"] == 4
        $lineHash = array();

        // "\x00" is a valid character, but various debuggers don't like it.
        // So we'll insert a junk entry to avoid generating a null character.
        $lineArray[] = '';

        $chars1 = $this->linesToCharsMunge($text1, $lineArray, $lineHash);
        $chars2 = $this->linesToCharsMunge($text2, $lineArray, $lineHash);

        return array($chars1, $chars2, $lineArray);
    }