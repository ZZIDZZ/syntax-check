public function gc($maxLife)
    {
        $db = Database::database();
        return $db->prepare('DELETE FROM sessions WHERE (UNIX_TIMESTAMP(session_expires) + ? ) < UNIX_TIMESTAMP(?)')->execute([$maxLife, date('Y-m-d H:i:s')]) ?
            true : false;
    }