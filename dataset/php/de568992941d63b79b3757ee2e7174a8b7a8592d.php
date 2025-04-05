public function registerPostTypes()
    {

        if (!function_exists('register_post_type')) {
            return;
        }

        $this->postTypes->rewind();
        while ($this->postTypes->valid()) {

            $postType = $this->postTypes->current();
            register_post_type($postType->getName(), $postType->getArgs());
            $this->postTypes->next();

        }

    }