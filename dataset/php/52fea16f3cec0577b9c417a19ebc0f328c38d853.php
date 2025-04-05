private function get_composer_json_path_backup_decoded() {
		$composer_json_obj = $this->get_composer_json();
		$json_path         = $composer_json_obj->getPath();
		$composer_backup   = file_get_contents( $json_path );
		if ( false === $composer_backup ) {
			$error = error_get_last();
			WP_CLI::error( sprintf( "Failed to read '%s': %s", $json_path, $error['message'] ) );
		}
		try {
			$composer_backup_decoded = $composer_json_obj->read();
		} catch ( Exception $e ) {
			WP_CLI::error( sprintf( "Failed to parse '%s' as json: %s", $json_path, $e->getMessage() ) );
		}

		return [ $json_path, $composer_backup, $composer_backup_decoded ];
	}