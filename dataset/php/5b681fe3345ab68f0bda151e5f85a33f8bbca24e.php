public function removeDirectory($recursive = false)
	{
		if (!$recursive) {
			return rmdir($this->path);
		}

		foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->path, \FilesystemIterator::SKIP_DOTS), \RecursiveIteratorIterator::CHILD_FIRST) as $path) {
			$path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname());
		}

		return true;
	}