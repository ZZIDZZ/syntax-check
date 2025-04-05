public function getUserStats($steamId) {
        if(!$this->hasStats()) {
            return null;
        }

        return GameStats::create($steamId, $this->appId);
    }