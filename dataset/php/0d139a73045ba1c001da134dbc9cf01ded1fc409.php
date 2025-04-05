public function analyzeUrl($url) {
		$url = trim($url);

		if (!preg_match('~^(https?)\\://([^/]+)(/.*|$)~', $url, $m)) {
			return false;
		}

		list (, $scheme, $host, $path) = $m;

		$path = self::normalizePath($path);

		$segments = ($path === '') ? array() : explode('/', $path);

		$ret = [
			'site_scheme' => $this->scheme,
			'site_host' => $this->host,
			'site_url_segments' => $this->url_segments,
			'host' => $host,
			'scheme' => $scheme,
			'path_within_site' => false,
			'url_segments' => $segments,
			'url_segments_within_site' => [],
		];

		$site_segments = $this->url_segments;
		while (count($site_segments)) {
			$site_segment = array_shift($site_segments);
			$segment = array_shift($segments);

			if ($segment !== $site_segment) {
				// not in site
				return $ret;
			}
		}

		$ret['path_within_site'] = true;
		$ret['url_segments_within_site'] = $segments;

		return $ret;
	}