protected function persist_added( $added ) {

		$cached = wp_cache_get( $this->parent->get_pk(), $this->get_cache_group() ) ?: array();

		global $wpdb;

		$insert = array();

		$parent = esc_sql( $this->parent->get_pk() );

		foreach ( $added as $model ) {
			$pk = esc_sql( $this->saver->get_pk( $model ) );

			if ( $pk ) {
				$insert[] = "({$parent},{$pk})";
				$cached[] = $pk;
			}
		}

		if ( empty( $insert ) ) {
			return;
		}

		wp_cache_set( $this->parent->get_pk(), $cached, $this->get_cache_group() );

		$insert = implode( ',', $insert );

		$sql = "INSERT IGNORE INTO `{$this->association->get_table_name( $wpdb )}` ";
		$sql .= "({$this->other_column},{$this->primary_column}) VALUES $insert";

		$wpdb->query( $sql );
	}