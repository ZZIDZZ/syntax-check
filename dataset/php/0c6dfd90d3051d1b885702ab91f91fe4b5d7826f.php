protected static function remove_dir($dst) {
		if (!$dst || !is_dir($dst)) return;	// prevent deleting an entire disk by accidentally calling this with an empty string!
		$dir = opendir($dst);

		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($dst . '/' . $file) ) {
					self::remove_dir($dst . '/' . $file);
				}
				else {
					unlink($dst . '/' . $file);
				}
			}
		}
		closedir($dir);
		rmdir($dst);
	}