public function generateMemoryToken($token, KeyPairReference $keyPair = null)
	{
		return new MemoryToken($token, $this->prepareKeyPair($keyPair));
	}