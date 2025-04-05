private function buildImageDescriptor(Frame $frame)
    {
        // seperator
        $descriptor = "\x2C";

        // image left/top
        $descriptor .= pack('v*', 
            $frame->offset->left, 
            $frame->offset->top
        );

        // image width/height
        $descriptor .= pack('v*', 
            $frame->size->width, 
            $frame->size->height
        );

        $interlacedFlag = $frame->isInterlaced() ? 1 : 0;
        $reserved1 = 0;
        $reserved2 = 0;

        if ($frame->hasLocalColorTable()) {
            $colorTableFlag = 1;
            $colorTableSize = log(strlen($frame->getLocalColorTable()) / 3, 2) - 1;
            $colorTableSize = decbin($colorTableSize);
            $sortFlag = 0;
        } else {
            $colorTableFlag = 0;
            $colorTableSize = 0;
            $sortFlag = 0;
        }

        $colorTableSize = str_pad($colorTableSize, 3, 0, STR_PAD_LEFT);

        // packed field
        $packed = $colorTableFlag.$interlacedFlag.$sortFlag.$reserved1.$reserved2.$colorTableSize;
        $descriptor .= pack('C', bindec($packed));

        if ($frame->hasLocalColorTable()) {
            // add local color table
            $descriptor .= $frame->getLocalColorTable();
        }
        
        return $descriptor;
    }