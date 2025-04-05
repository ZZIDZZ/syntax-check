private function set_page($intPage = 1)
    {
        if (!isset($this->arrPayload['count'])) {
            throw new DocumentSearchMissingCount('\DocumentSearch::setPerPage() is required before \DocumentSearch::setPage()');
        }

        // get the page
        if (isset($this->arrSearch['page'])) {
            $intPage = $this->arrSearch['page'];
        }

        // set the starting point
        $this->arrPayload['start'] = $this->arrPayload['count'] * ($intPage - 1);

        return $this;
    }