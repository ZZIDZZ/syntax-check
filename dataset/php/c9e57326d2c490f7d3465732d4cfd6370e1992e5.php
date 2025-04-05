public function destroy(): void {
		
		// see example here http://goo.gl/nBVl0
		
		$this->logout();
		$p = session_get_cookie_params();
		setcookie(session_name(), "", time() - 42000, $p["path"],
			$p["domain"], $p["secure"], $p["httponly"]);
		
		session_destroy();
	}