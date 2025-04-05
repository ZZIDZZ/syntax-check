protected function fetchMessage() {
		if ( $this->message === null ) {
			$this->message = $this->ctx->getMessageCache()->get(
				$this->key,
				array(
					$this->ctx->getCurrentLanguage(),
					$this->ctx->getDefaultLanguage(),
			) );
		}
		return $this->message;
	}