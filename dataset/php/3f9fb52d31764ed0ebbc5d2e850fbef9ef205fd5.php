public function sendfile(): bool
    {
        if ($this->internalError) {
            $this->sendInternalError();
            return false;
        }
        if ($this->cacheok) {
            header("HTTP/1.1 304 Not Modified");
            return true;
        }
        if (is_null($this->path)) {
            header("HTTP/1.0 404 Not Found");
            return false;
        }
        if ($this->badrange) {
            header("HTTP/1.1 416 Range Not Satisfiable");
            return false;
        }
        if ($this->istext) {
            return $this->serveText();
        }
        return $this->sendContent();
    }