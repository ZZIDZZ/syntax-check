final public function go($destination, $args = [], $snippets = [], $presenterForward = FALSE) {
		if($this->ajaxEnabled && $this->presenter->isAjax()) {
			foreach($snippets as $snippet) {
				$this->redrawControl($snippet);
			}

			if($presenterForward) {
				$this->presenterForward($destination, $args);
			} else {
				$this->forward($destination, $args);
			}
		} else {
			$this->redirect($destination, $args);
		}
	}