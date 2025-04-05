public function isEditingAnyway()
    {
        if (!$this->canEditAnyway()) {
            return false;
        }

        $sessionVar = 'EditAnyway_' . Member::currentUserID() . '_' . $this->ID;
        if (Controller::curr()->getRequest()->getVar('editanyway') == '1') {
            Session::set($sessionVar, true);
            return true;
        }
        return Session::get($sessionVar) ? true : false;
    }