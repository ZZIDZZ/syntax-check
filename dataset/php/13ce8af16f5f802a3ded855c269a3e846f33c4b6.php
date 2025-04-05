public function favoritedBy()
	{
		return $this->favorites()->with('user')->get()->mapWithKeys(function ($item) {
            return [$item['user']->id => $item['user']];
        });
	}