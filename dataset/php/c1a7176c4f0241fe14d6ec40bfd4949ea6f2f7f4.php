private function getLine(string $content, int $styles = null, int $paddingLength = null):string
    {
        $termCols = $this->countTermCols();

        // title lines
        if ($styles & self::STYLE_TITLE || $styles & self::STYLE_SUBTITLE) {
            $styles |= self::STYLE_BOLD | self::STYLE_CENTER;
            $titleSide = str_pad("", $styles & self::STYLE_TITLE ? 4 : 2, "-");
            $content = ($titleSide ? "$titleSide " : "").strtoupper($content).($titleSide ? " $titleSide" : "");
        }

        // centering
        if ($styles & self::STYLE_CENTER && strlen($content) < $termCols) {
            $leftPadding = ceil(($termCols - strlen($content)) / 2) + strlen($content);
            $content = str_pad(str_pad($content, $leftPadding, " ", STR_PAD_LEFT),
                $termCols, " ");
        }

        // adding padding
        $paddedContent = "";
        $paddingLength = $paddingLength === null ? 2 : $paddingLength + 2;
        $padding = str_pad("", $paddingLength, " ");
        $availableCols = $termCols - $paddingLength * 2;
        // processing the content by line
        foreach (explode("\n", $content) as $contentLine) {
            $paddedLine = "";

            // processing the content word by word
            foreach (explode(" ", $contentLine) as $word) {
                if (strlen("$paddedLine $word") >= $availableCols) {
                    $paddedContent .= (!empty($paddedContent) ? "\n" : "")
                        .$padding
                        .str_pad($paddedLine, $availableCols, " ")
                        .$padding;
                    $paddedLine = "";
                }
                $paddedLine .= "$word ";
            }

            if (!empty($paddedLine)) {
                $paddedContent .= (!empty($paddedContent) ? "\n" : "")
                    .$padding
                    .str_pad($paddedLine, $availableCols, " ")
                    .$padding;
            }
        }

        // applying colors
        if ($this->options & self::OPT_COLORS && $this->termColor instanceof Color) {
            $paddedContent = $this->termColor->bg('red', $this->termColor->apply('white', $paddedContent));
            if ($styles & self::STYLE_BOLD) {
                $paddedContent = $this->termColor->apply('bold', $paddedContent);
            }
            if ($styles & self::STYLE_ITALIC) {
                $paddedContent = $this->termColor->apply('italic', $paddedContent);
            }
        }
        return "$paddedContent\n";
    }