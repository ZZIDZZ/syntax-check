private function generateConstraintSQL($info) {
        $name = isset($info['name']) ? $info['name'] : $this->generateForeignKeyName($info);
        $sql = 'CONSTRAINT `'.$name.'` FOREIGN KEY (`'.$info['local_field'].'`) REFERENCES `'
            .$info['foreign_table'].'` (`'.$info['foreign_field'].'`) '.
            'ON DELETE '.(empty($info['on_delete']) ? 'SET NULL' : $info['on_delete']).' ON UPDATE '.(empty($info['on_update']) ? 'CASCADE' : $info['on_update']);
        return $sql;
    }