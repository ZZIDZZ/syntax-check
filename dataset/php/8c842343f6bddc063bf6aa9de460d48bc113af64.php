public function excerpts($files)
    {
        // Create array to hold posts
        $posts = array();

        // Iterate through files and get excerpts for all of them
        foreach ($files as $file) {
            $file_contents = $this->sonic->app['filesystem']->parse($file);

            if (
                $file_contents['meta']['title'] !== 'Quote'
                &&
                $this->sonic->app['settings']['site.excerpt_newline_limit'] !== 0
            ) {
                $contents  = $this->sonic->app['helper']->get_excerpt(
                    $file_contents['contents'],
                    $this->sonic->app['settings']['site.excerpt_newline_limit']
                );

                $file_contents['contents'] = $contents;
            }
            $posts[str_replace('content/', '', $file)] = $file_contents;
        }

        return $posts;
    }