public function forkThread($callback, array $params = [])
	{
		$res = pcntl_fork();
		if ($res < 0)
			throw new Exception('Can\'t fork');

		if ($res === 0) {
			call_user_func_array($callback, $params);
			exit;
		} else {
			return $res;
		}
	}