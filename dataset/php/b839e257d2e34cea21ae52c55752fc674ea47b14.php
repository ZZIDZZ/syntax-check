public function changePass($old, $new1, $new2)
    {
        if(!$this->auth->authUser($this->user, $old))
            return False;
        elseif($new1 != $new2)
            return False;
        else
            $hash = password_hash($new1, PASSWORD_BCRYPT);
            return $this->auth->db->update($this->auth->prefix.'users', ['pass' => $hash] , ['id' => $this->id]);
    }