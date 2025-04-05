protected function remove_js_strings_from_po_file( $source_file ) {
		/** @var Translations[] $mapping */
		$translations = new Translations();

		PoExtractor::fromFile( $source_file, $translations );

		foreach ( $translations->getArrayCopy() as $translation ) {
			/** @var Translation $translation */

			if ( ! $translation->hasReferences() ) {
				continue;
			}

			foreach ( $translation->getReferences() as $reference ) {
				$file = $reference[0];

				if ( substr( $file, - 3 ) !== '.js' ) {
					continue 2;
				}
			}

			unset( $translations[ $translation->getId() ] );
		}

		return PoGenerator::toFile( $translations, $source_file );
	}