private function normalRandom($size)
    {
        $id = '';
        while (1 <= $size--) {
            $rand = mt_rand()/(mt_getrandmax() + 1);
            $id .= $this->alphbet[$rand*64 | 0];
        }

        return $id;
    }