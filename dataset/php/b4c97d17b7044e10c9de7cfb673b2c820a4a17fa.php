protected function getWPTerms($options = [], $value = 'term_id')
    {
        // Build contents
        $contents = [];
        $contents[-1] = Translate::t('wordpress.choose.term', [], 'wordpressfield');

        // Build options
        $args = array_merge([
            'hide_empty' => false,
        ], $options);

        // Build request
        $terms_obj = get_terms($args);

        // Iterate on tags
        if (!empty($terms_obj) && ! is_wp_error($terms_obj)) {
            foreach ($terms_obj as $term) {
                // Check value
                $item = !empty($value) && isset($term->$value) ? $term->$value : $term->term_id;

                // Get the id and the name
                $contents[0][$item] = $term->name;
            }
        }

        // Return all values in a well formatted way
        return $contents;
    }