public function pop()
    {
        $data = $this->top();

        if (is_array($data) && count($data)) {
            $query = 'DELETE FROM `' . $this->table . '` WHERE `id` = ' . $data["id"];
            $this->execute($query);
            return $data;
        }

        return array();
    }