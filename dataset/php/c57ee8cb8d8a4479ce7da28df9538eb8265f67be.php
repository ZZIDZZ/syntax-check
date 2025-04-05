public function getTemplate($file) {
        $ext = $this->extension;

        if (!empty($ext) && (substr($file, -1 * strlen($ext)) != $ext)) {
            $file .= $ext;
        }

        if ((substr($file, 0, 1) == '/')) {
            return $file;
        }
        
        return $this->path.'/'.$file;
    }