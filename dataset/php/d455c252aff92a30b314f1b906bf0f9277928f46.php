public function update(Application $application)
    {
        $rows = array();

        foreach ($this->getRows() as $row) {
            if ($row['id'] == $application->getId()) {
                $row = array(
                    'id'   => $application->getId(),
                    'name' => $application->getName(),
                    'url'  => $application->getUrl()
                );
            }
            $rows[] = $row;
        }

        file_put_contents($this->filename, Yaml::dump($rows));
    }