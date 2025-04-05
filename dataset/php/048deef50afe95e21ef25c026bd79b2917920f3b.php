public function getProperties($sessionName, $path, $cb)
    {
        if (!$this->validateSessionName($sessionName, $cb))
            return false;

        $exception = null;
        $msg = null;
        $names = array ();

        try {
            $parent = $this->sessions[$sessionName]->getNode($path);
            $properties = $parent->getProperties ();
            $names = array_keys ($properties);
        } catch (\Exception $e) {
            $exception = get_class($e);
            $msg = $e->getMessage();
        }

        $cb($names, $exception, $msg);
    }