protected static function convert($original = '') {
    $array = [];
    // Only search for tags within header section, if demarcated.
    $header_split = preg_split('/<End Header>/', $original);
    preg_match_all("/<([a-zA-Z0-9_ -]*):([a-zA-Z0-9_&;, -]*)>/", $header_split[0], $matches, PREG_SET_ORDER);
    if (isset($matches[0])) {
      // Store <TAGNAME: VALUE> strings.
      foreach ($matches as $key => $values) {
        $values[2] = trim($values[2]);
        $multiple_terms = preg_grep('/;/', explode("\n", $values[2]));
        if (!empty($multiple_terms)) {
          $terms = preg_split('/;/', $values[2]);
          foreach ($terms as $i => &$term) {
            if (empty($term)) {
              unset($terms[$i]);
            }
            $term = (string) trim($term);
          }
        }
        else {
          $terms = (string) trim($values[2]);
        }
        $array[trim($values[1])] = $terms;
      }
    }

    // Remove tags and parse each line into an array element.
    if (isset($header_split[1])) {
      $untagged = $header_split[1];
    }
    else {
      $untagged = preg_replace("/<([a-zA-Z0-9_ -]*):([a-zA-Z0-9_&;, -]*)>/", "", $original);
      $untagged = str_replace('<End Header>', '', $untagged);
    }
    $clean = '';
    $lines = preg_split('/((\r?\n)|(\n?\r))/', htmlspecialchars($untagged, ENT_NOQUOTES));
    $end = end($lines);
    foreach ($lines as $key => $line) {
      if ($line != '') {
        $clean .= $line;
        if ($key != $end) {
          $clean .= PHP_EOL;
        }
      }
    }
    // Add a new array element, 'text', to the array. If nothing else, the
    // $array array will now contain the 'text' element with an empty string.
    $array['text'] = $clean;
    return $array;
  }