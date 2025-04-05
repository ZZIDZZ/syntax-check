public function getNestedItem($pattern, $object, $default = null)
    {
        $parts = explode("/", $pattern);
        $lastObject = $object;
        $nr = 0;
        $totalParts = count($parts);
        $item = null;
        foreach ($parts as $part) {
            $item = null;
            $nr++;
            $found = false;
            if ($part == '') {
                return $default;
            }
            try {
                if (is_object($lastObject)) {
                    $mthd = 'get' . ucfirst($part);
                    $mthdIs = 'is' . ucfirst($part);
                    if (substr($part, 0, 2) == '::') {
                        $reflect = new \ReflectionObject($lastObject);
                        $props = $reflect->getStaticProperties();
                        $nm = substr($part, 2);
                        if (isset($props[$nm])) {
                            $prop = $reflect->getProperty($nm);
                            if ($prop->isPublic()) {
                                $item = $lastObject::$$nm;
                            }
                        }
                    } elseif (is_callable([$lastObject, $mthd])) {
                        $item = $lastObject->$mthd();
                    } elseif (is_callable([$lastObject, $mthdIs])) {
                        $item = $lastObject->$mthdIs();
                    } elseif (is_callable([$lastObject, $part])) {
                        $item = $lastObject->$part();
                    } else {
                        $reflect = new \ReflectionObject($lastObject);
                        $prop = $reflect->getProperty($part);
                        if ($prop->isPublic()) {
                            $item = $lastObject->$part;
                        }
                    }
                    $found = true;
                } elseif (is_array($lastObject)) {
                    if (array_key_exists($part, $lastObject)) {
                        $item = $lastObject[$part];
                        $found = true;
                    }
                }
            } catch (\Exception $e) {
                return $default;
            }
            if ((!is_null($item) && !is_object($item) && !is_array($item) && $nr < $totalParts) || !$found) {
                //its a string,boolean or integer , but we're not at the end of the list so we can't find the end
                return $default;
            }
            $lastObject = $item;
        }
        return $item;
    }