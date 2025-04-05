public function update($id, $data)
    {
        $data = $this->sanitizeData((array)$data);
        return $this->getRepository()->update($id, $data);
    }