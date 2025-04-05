private function _setWebservicesUrl() {
		$ws_url = $this->url . '&format=json';
		
		if ($this->token) {
			$ws_url .= '&h=' . $this->token;
		}
		
		if ($this->username) {
			$ws_url .= '&u=' . $this->username;
		}
		
		if ($this->password) {
			$ws_url .= '&p=' . $this->password;
		}
		
		if ($this->operation) {
			$ws_url .= '&op=' . $this->operation;
		}
		
		if ($this->from) {
			$ws_url .= '&from=' . urlencode($this->from);
		}
		
		if ($this->to) {
			$ws_url .= '&to=' . urlencode($this->to);
		}
		
		if ($this->footer) {
			$ws_url .= '&footer=' . urlencode($this->footer);
		}
		
		if ($this->nofooter) {
			$ws_url .= '&nofooter=' . $this->nofooter;
		}
		
		if ($this->msg) {
			$ws_url .= '&msg=' . urlencode($this->msg);
		}
		
		if ($this->schedule) {
			$ws_url .= '&schedule=' . $this->schedule;
		}
		
		if ($this->type) {
			$ws_url .= '&type=' . $this->type;
		}
		
		if ($this->unicode) {
			$ws_url .= '&unicode=' . $this->unicode;
		}
		
		if ($this->queue) {
			$ws_url .= '&queue=' . $this->queue;
		}
		
		if ($this->src) {
			$ws_url .= '&src=' . urlencode($this->src);
		}
		
		if ($this->dst) {
			$ws_url .= '&dst=' . urlencode($this->dst);
		}
		
		if ($this->datetime) {
			$ws_url .= '&dt=' . $this->datetime;
		}
		
		if ($this->smslog_id) {
			$ws_url .= '&smslog_id=' . $this->smslog_id;
		}
		
		if ($this->last_smslog_id) {
			$ws_url .= '&last=' . $this->last_smslog_id;
		}
		
		if ($this->count) {
			$ws_url .= '&c=' . $this->count;
		}
		
		if ($this->keyword) {
			$ws_url .= '&kwd=' . urlencode($this->keyword);
		}
		
		$this->webservices_url = $ws_url;
	}