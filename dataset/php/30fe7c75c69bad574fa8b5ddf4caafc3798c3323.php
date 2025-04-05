public function read($session_id) {

    // Check for the existance of a cookie with the name of the session id
    // Make sure that the cookie is atleast the size of our hash, otherwise it's invalid
    // Return an empty string if it's invalid.
    if (! $this->storage->has($session_id)) return '';

    try {
      $data = $this->storage->get($session_id);
    } catch (HashMismatchException $ex) {
      $data = '';
    }

    // Return the data, now that it's been verified.
    return $data;
  }