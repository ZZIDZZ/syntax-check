public function build($build=false)
    {
        if($build){
            header('Content-Type: application/json');
            echo json_encode($this->json);
            return true;
        }

        return json_encode($this->json);
    }