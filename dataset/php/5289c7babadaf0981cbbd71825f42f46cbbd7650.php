public function sort()
    {
        if ($this->request->is('post')) {
            $order = explode(",", $_POST['order']);
            $i = 1;
            foreach ($order as $photo) {
                $this->Picture->read(null, $photo);
                $this->Picture->set('order', $i);
                $this->Picture->save();
                $i++;
            }
        }

        $this->render(false, false);
    }