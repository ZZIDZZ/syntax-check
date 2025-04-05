public function decode( $charset ) {
		$this->merchantId         = base64_decode( $this->merchantId );
		$this->account            = base64_decode( $this->account );
		$this->amount             = base64_decode( $this->amount );
		$this->authCode           = base64_decode( $this->authCode );
		$this->batchId            = base64_decode( $this->batchId );
		$this->cavv               = base64_decode( $this->cavv );
		$this->cvnResult          = base64_decode( $this->cvnResult );
		$this->eci                = base64_decode( $this->eci );
		$this->commentOne         = base64_decode( $this->commentOne );
		$this->commentTwo         = base64_decode( $this->commentTwo );
		$this->message            = base64_decode( $this->message );
		$this->pasRef             = base64_decode( $this->pasRef );
		$this->hash               = base64_decode( $this->hash );
		$this->result             = base64_decode( $this->result );
		$this->xid                = base64_decode( $this->xid );
		$this->orderId            = base64_decode( $this->orderId );
		$this->timeStamp          = base64_decode( $this->timeStamp );
		$this->AVSAddressResult   = base64_decode( $this->AVSAddressResult );
		$this->AVSPostCodeResult = base64_decode( $this->AVSPostCodeResult );

		if (is_array($this->tss)) {
			foreach ( $this->tss as $key => $value ) {
				$this->tss[ $key ] = base64_decode( $value );
			}
		}

		if (is_array($this->supplementaryData)) {
			foreach ( $this->supplementaryData as $key => $value ) {
				$this->supplementaryData[ $key ] = base64_decode( $value );
			}
		}

		return $this;
	}