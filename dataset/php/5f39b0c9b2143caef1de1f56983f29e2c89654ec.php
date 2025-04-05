static public function toQtiDatatype($cardinality, $basetype, $value)
    {
        // @todo support all baseTypes
        $datatype = null;
        
        if (is_string($value) && empty($value) === false && $cardinality !== 'record' && ($basetype === 'identifier' || $basetype === 'pair' || $basetype === 'directedPair' || $basetype === 'boolean')) {
            if ($cardinality !== 'simple') {
                $value = trim($value, "<>[]");
                $value = explode(';', $value);
            } else {
                $value = array($value);
            }
            
            if (count($value) === 1 && empty($value[0]) === true) {
                $value = array();
            }
            
            $value = array_map(
                function($val) {
                    return trim($val);
                },
                $value
            );
            
            $qtiBasetype = BaseType::getConstantByName($basetype);
            $datatype = ($cardinality === 'ordered') ? new OrderedContainer($qtiBasetype) : new MultipleContainer($qtiBasetype);
            foreach ($value as $val) {
                try {
                    switch ($basetype) {
                        case 'identifier':
                            $datatype[] = new QtiIdentifier($val);
                            break;
                            
                        case 'pair':
                            $pair = explode("\x20", $val);
                            if (count($pair) === 2) {
                                $datatype[] = new QtiPair($pair[0], $pair[1]);
                            }
                            break;
                            
                        case 'directedPair':
                            $pair = explode("\x20", $val);
                            if (count($pair) === 2) {
                                $datatype[] = new QtiDirectedPair($pair[0], $pair[1]);
                            }
                            break;
                            
                        case 'boolean':
                            if ($val === 'true') {
                                $datatype[] = new QtiBoolean(true);
                            } elseif ($val === 'false') {
                                $datatype[] = new QtiBoolean(false);
                            } else {
                                $datatype[] = new QtiBoolean($val);
                            }
                            break;
                    }
                } catch (InvalidArgumentException $e) {
                    $datatype = null;
                    break;
                }
            }
            
            $datatype = ($cardinality === 'single') ? (isset($datatype[0]) ? $datatype[0] : null) : $datatype;
        }
        
        return $datatype;
    }