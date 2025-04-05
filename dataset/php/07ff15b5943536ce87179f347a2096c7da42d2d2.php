public function createMpdfInstance(
        $format = 'A4',
        $fontSize = 0,
        $fontFamily = '',
        $marginLeft = 15,
        $marginRight = 15,
        $marginTop = 16,
        $marginBottom = 16,
        $marginHeader = 9,
        $marginFooter = 9,
        $orientation = 'P'
    )
    {
        if (!(is_array($format) && count($format) == 2) || !in_array(strtoupper($format), $this->getAcceptedFormats())) {
            $format = 'A4';
        }

        $constructorArgs = array(
            'utf-8',
            $this->validateFormat($format),
            (int)$fontSize,
            $fontFamily,
            (int)$marginLeft,
            (int)$marginRight,
            (int)$marginTop,
            (int)$marginBottom,
            (int)$marginHeader,
            (int)$marginFooter,
            $this->validateOrientation($orientation));

        $reflection = new \ReflectionClass('\mPDF');
        $this->mpdf = $reflection->newInstanceArgs($constructorArgs);
    }