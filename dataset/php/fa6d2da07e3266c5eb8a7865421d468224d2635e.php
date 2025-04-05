protected function getFontGoogle($api_key = '')
    {
        // Check API KEY
        if (!empty($api_key)) {
            $fonts = $this->getFontViaAPI($api_key);

            // Check fonts
            if (is_array($fonts) && !empty($fonts)) {
                return $fonts;
            }
        }

        /**
         * Return best fonts from Chad Mazzola
         * @see http://hellohappy.org/beautiful-web-type/
         */
        return [
            'sans_serif'    => [
                'name'  => 'sansserif',
                'title' => 'sansserif',
                'sizes' => '',
            ],
            'abril_fatface' => [
                'name'  => 'Abril+Fatface',
                'title' => 'Abril Fatface',
                'sizes' => '',
            ],
            'cardo'         => [
                'name'  => 'Cardo',
                'title' => 'Cardo',
                'sizes' => '400,400italic',
            ],
            'gravitas_one'  => [
                'name'  => 'Gravitas+One',
                'title' => 'Gravitas One',
                'sizes' => '',
            ],
            'lato'          => [
                'name'  => 'Lato',
                'title' => 'Lato',
                'sizes' => '100,900',
            ],
            'merriweather'  => [
                'name'  => 'Merriweather',
                'title' => 'Merriweather',
                'sizes' => '400,900',
            ],
            'open_sans'     => [
                'name'  => 'Open+Sans',
                'title' => 'Open Sans',
                'sizes' => '300,400,600,700,800',
            ],
            'oswald'        => [
                'name'  => 'Oswald',
                'title' => 'Oswald',
                'sizes' => '300,400,700',
            ],
            'playfair_display'  => [
                'name'  => 'Playfair+Display',
                'title' => 'Playfair Display',
                'sizes' => '400,900,700italic',
            ],
            'pt_sans'       => [
                'name'  => 'PT+Sans',
                'title' => 'PT Sans',
                'sizes' => '400,700',
            ],
            'vollkorn'      => [
                'name'  => 'Vollkorn',
                'title' => 'Vollkorn',
                'sizes' => '400,400italic',
            ],
        ];
    }