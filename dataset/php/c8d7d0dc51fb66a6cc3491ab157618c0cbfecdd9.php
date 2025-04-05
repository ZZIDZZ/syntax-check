public function patch($url, $data, array $headers = array(), $timeout = null)
	{
		return $this->makeTransportRequest('PATCH', $url, $data, $headers, $timeout);
	}