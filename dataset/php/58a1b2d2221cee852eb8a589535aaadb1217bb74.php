private function sanitize_widget_options( $id_base, $dirty_options, $old_options ) {

		$widget = $this->get_widget_obj( $id_base );
		if ( empty( $widget ) ) {
			return array();
		}

		// No easy way to determine expected array keys for $dirty_options
		// because Widget API dependent on the form fields
		// phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- Whitelisting due to above reason.
		return @$widget->update( $dirty_options, $old_options );

	}