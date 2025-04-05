public function labelCallback($arrRow)
    {
        // get the target URL
        $targetURL = \ShortURLs::processTarget( $arrRow['target'] );

        // remove current host
        $targetURL = str_replace( \Environment::get('base'), '', $targetURL );

        // check for domain restriction
        $domain = '';
        if( $arrRow['domain'] && ( $objPage = \PageModel::findById( $arrRow['domain'] ) ) !== null )
            $domain = $objPage->dns . '/';

        // generate list record
        return '<div class="tl_content_right"><span style="color:rgb(200,200,200)">[' . ( $arrRow['redirect'] == 'permanent' ? 301 : 302 ) . ']</span></div><div class="tl_content_left">' . $domain . rawurldecode($arrRow['name']) . ' &raquo; ' . rawurldecode($targetURL) . ' </div>';
    }