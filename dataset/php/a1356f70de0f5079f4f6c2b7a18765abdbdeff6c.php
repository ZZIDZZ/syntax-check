public static function check_allowed_aliases($alias, $mimes=null) {
		// Default MIMEs.
		if (empty($mimes)) {
			$mimes = get_allowed_mime_types();
		}

		$alias = strtolower(sanitize_mime_type($alias));

		$ext = $type = false;

		// Early bail opportunity.
		if (!$alias || !count($mimes)) {
			return false;
		}

		// Direct hit!
		if (false !== $extensions = array_search($alias, $mimes, true)) {
			$extensions = explode('|', $extensions);
			$ext = $extensions[0];
			$type = $alias;

			return compact('ext', 'type');
		}

		// Try all extensions.
		foreach ($mimes as $extensions=>$mime) {
			$extensions = explode('|', $extensions);
			foreach ($extensions as $extension) {
				if (static::check_alias($extension, $alias)) {
					$ext = $extension;
					$type = $mime;

					return compact('ext', 'type');
				}
			}
		}

		return false;
	}