protected function getModuleOptions()
    {
        $entitys = $this->moduleService->getAll(array(
            'pagination' => 'off'
        ));
        
        $options = array();
        
        foreach ($entitys as $entity) {
            $options[$entity->getModuleId()] = $entity->getModuleName();
        }
        
        return $options;
    }