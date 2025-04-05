public function usort( \Closure $callback )
	{
		usort( $this->data, $callback );
		reset( $this->data );

		return $this;
	}