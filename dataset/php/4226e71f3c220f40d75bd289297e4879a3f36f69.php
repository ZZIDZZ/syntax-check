private function getLastWidth(&$currentWidthValue, $width, $nextWidth)
    {
        $widthNumber = $this->getItemWidthNumber($width);
        $nextWidthNumber = $this->getItemWidthNumber($nextWidth);

        $currentWidthValue += $widthNumber;

        if (0 == $currentWidthValue % 12) {
            return true;
        }

        // if next item has no space in current row the current item is last
        if (($currentWidthValue % 12) + $nextWidthNumber > 12) {
            $currentWidthValue += 12 - $currentWidthValue % 12;

            return true;
        }

        return false;
    }