protected function registerAuthRoutes()
	{
		$this->laravelRouter->group([
			'prefix'    => $this->prefix,
			'namespace' => 'SleepingOwl\Admin\Controllers'
		], function ()
		{
			$this->laravelRouter->get('login', [
				'as'   => $this->routePrefix . '.login',
				'uses' => 'AuthController@getLogin'
			]);
			$this->laravelRouter->post('login', [
				'as'   => $this->routePrefix . '.login.post',
				'uses' => 'AuthController@postLogin'
			])->before('csrf');
			$this->laravelRouter->get('logout', [
				'as'   => $this->routePrefix . '.logout',
				'uses' => 'AuthController@getLogout'
			]);
		});
	}