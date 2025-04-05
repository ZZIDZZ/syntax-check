protected function parseSearch($data)
    {
        $html = HtmlDomParser::str_get_html($data);
        $groups = array();
        foreach ($html->find('li.groupreference') as $e) {
            $item = array();
            $item['regid'] =  $e->find('span.regid', 0)->innertext;
            $item['title'] =  $e->find('span.title', 0)->innertext;
            $item['description'] = $e->find('span.description', 0)->innertext;
            array_push($groups, $item);
        }
        return $groups;
    }