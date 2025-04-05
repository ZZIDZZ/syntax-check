private function paginate() {
        $canvas = $this->pdf->get_canvas();
        $c = array_merge($this->_pagination, $this->config['paginate']);
        $canvas->page_text($c['x'], $c['y'], $c['text'], $c['font'], $c['size'], $c['color']);
    }