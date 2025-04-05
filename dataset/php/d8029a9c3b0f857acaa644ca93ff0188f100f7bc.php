public function ChartTitle() {
		$stamp = $this->getStartDateStamp();
		$key = $this->DateFormat == "dmy" ? "j M, Y" : "M j, Y";
		$title = date($key, $stamp) . " - " . date($key);
		if($this->getPath()) {
			$title .= " ("._t('Dashboard.PATH','Path').": {$this->getPath()})";
		}
		else {
			$title .= " ("._t('Dashboard.ENTIRESITE','Entire site').")";
		}
		return $title;

	}