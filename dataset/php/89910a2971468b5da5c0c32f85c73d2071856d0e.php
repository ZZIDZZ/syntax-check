protected function getTypedDataIds(array $types, array $context = []) {

    // The 'type' can potentially contain an array of type objects. By default,
    // Drupal only uses a single type in serializing, but allows for multiple
    // types when deserializing.
    if (isset($types['href'])) {
      $types = [$types];
    }

    foreach ($types as $type) {
      if (!isset($type['href'])) {
        throw new UnexpectedValueException('Type must contain an \'href\' attribute.');
      }
      $type_uri = $type['href'];
      // Check whether the URI corresponds to a known type on this site. Break
      // once one does.
      if ($typed_data_ids = $this->linkManager->getTypeInternalIds($type['href'], $context)) {
        break;
      }
    }

    // If none of the URIs correspond to an entity type on this site, no entity
    // can be created. Throw an exception.
    if (empty($typed_data_ids)) {
      throw new UnexpectedValueException(sprintf('Type %s does not correspond to an entity on this site.', $type_uri));
    }

    return $typed_data_ids;
  }