public function acceptOrDeny()
    {
        if (!isset($_POST['postId']) || !isset($_POST['value'])) {
            echo _e('Something went wrong!', 'event-integration');
            die();
        }

        $postId = $_POST['postId'];
        $value = $_POST['value'];

        $post = get_post($postId);
        if ($value == 0) {
            $post->post_status = 'draft';
        }
        if ($value == 1) {
            $post->post_status = 'publish';
        }

        $update = wp_update_post($post, true);
        if (is_wp_error($update)) {
            echo _e('Error', 'event-integration');
            die();
        }

        echo $value;
        die();
    }