public function initScheduler($postId) : bool
    {
        $active = true;
        $post_types = get_field('content_scheduler_posttypes', 'option');

        if (is_array($post_types) && !empty($post_types)) {
            $current = get_post_type($postId);
            $active = in_array($current, $post_types);
        }

        return $active;
    }