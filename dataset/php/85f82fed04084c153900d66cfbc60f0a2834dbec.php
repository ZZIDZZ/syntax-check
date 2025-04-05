public static function batchRecord( IDatabase $dbw, $items ) {
		if ( !count( $items ) ) {
			return false;
		}
		$fields = [];
		/**
		 * @var $item SpoofUser
		 */
		foreach ( $items as $item ) {
			$fields[] = $item->insertFields();
		}
		$dbw->replace(
			'spoofuser',
			[ 'su_name' ],
			$fields,
			__METHOD__ );
		return true;
	}