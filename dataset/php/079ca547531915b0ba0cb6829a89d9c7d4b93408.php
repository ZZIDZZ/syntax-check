public function apply($modifier) {
		if (is_callable($modifier)) {
			foreach ($this->props as $prop => $value) {
				$this->__set($prop, $modifier($value, $prop));
			}
		} else {
			foreach ($modifier as $key => $mod) {
				if (is_callable($mod)) {
					$this->props->$key = $mod(isset($this->props->$key) ? $this->props->$key : null, $key);
				} elseif (is_array($mod)) {
					$this->props->$key->apply($mod);
				} else {
					/* */
				}
			}
		}
		return $this;
	}