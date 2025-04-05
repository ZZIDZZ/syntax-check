public function build(array $data)
    {
        $this->validateArrayKeys(
            array('amount', 'create_time', 'update_time', 'state', 'parent_payment', 'id', 'valid_until', 'links'),
            $data
        );

        $links = array();
        foreach ($data['links'] as $link) {
            $links[] = $this->linkBuilder->build($link);
        }

        $authorization = new Authorization(
            $data['id'],
            $data['create_time'],
            $data['update_time'],
            $this->amountBuilder->build($data['amount']),
            $data['state'],
            $data['parent_payment'],
            $data['valid_until'],
            $links
        );

        return $authorization;
    }