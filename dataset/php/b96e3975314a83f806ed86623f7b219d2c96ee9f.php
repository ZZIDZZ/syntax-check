public function addCoordinate()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->coordinates[] = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            $coordinate = new Coordinate($args[0], $args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $coordinate->setNoWrap($args[2]);
            }

            $this->coordinates[] = $coordinate;
        } else {
            throw OverlayException::invalidPolygonCoordinate();
        }
    }