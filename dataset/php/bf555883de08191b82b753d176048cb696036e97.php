public function add($type, $message, $title = null,$options = array()) {
        $allowedTypes = array('error', 'info', 'success', 'warning');
        if(!in_array($type, $allowedTypes)) return false;

        $this->notifications[] = array(
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'options' => $options
        );

        $this->session->flash('toastr::notifications', $this->notifications);
    }