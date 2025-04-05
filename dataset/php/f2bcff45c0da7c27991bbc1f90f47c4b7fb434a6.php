public function takeWhile($callable)
    {
        $newElements = array();

        for ($i=0,$c=count($this->elements); $i<$c; $i++) {
            if (call_user_func($callable, $this->elements[$i]) !== true) {
                break;
            }

            $newElements[] = $this->elements[$i];
        }

        return $this->createNew($newElements);
    }