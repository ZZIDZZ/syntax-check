public function raw($idOrClosure)
    {
        if (is_object($idOrClosure) && method_exists($idOrClosure, "__invoke")) {
            $this->raws->attach($idOrClosure);

            return $idOrClosure;
        }

        if (!isset($this->definitions[$idOrClosure])) {
            return null;
        }

        return $this->definitions[$idOrClosure];
    }