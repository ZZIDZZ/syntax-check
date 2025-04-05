public function select($compare, $keys, $limit = 1, $begin = 0)
    {
        $sk = $this->keys;
        if (is_array($keys)) {
            foreach ($sk as &$value) {
                if (!isset($keys[$value])) {
                  break;
                }
                $value = $keys[$value];
            }
            array_slice($sk, 0, count($keys));
        } else {
            $sk = array($keys);
        }
        $this->io->select($this->indexId, $compare, $sk, $limit, $begin);
        $ret = $this->io->registerCallback(array($this, 'selectCallback'));
        if ($ret instanceof ErrorMessage) {
            throw $ret;
        }

        return $ret;
    }