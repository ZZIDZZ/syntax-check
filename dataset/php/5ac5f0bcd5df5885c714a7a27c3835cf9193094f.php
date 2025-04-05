public function execute($params = []){
    $this->db->execute($this->db->getSQL(), $params);
    $this->db->setFetchModeClass(__CLASS__);
    
    return $this->db->fetchAll();
  }