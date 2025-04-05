public function delete($name) {
        $name = trim((string)$name);
        if (empty($name)) {
            return false;
        }

        $table = YOURLS_DB_TABLE_OPTIONS;
        $sql = "DELETE FROM $table WHERE option_name = :name";
        $bind = array('name' => $name);
        $do   = $this->ydb->fetchAffected($sql, $bind);

        if($do !== 1) {
            // Something went wrong :(
            return false;
        }

        yourls_do_action('delete_option', $name);
        $this->ydb->delete_option($name);
        return true;
    }