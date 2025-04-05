protected function delete($payload)
    {
        $id = $payload[0];
        $this->touchIndex(function (&$data) use ($id) {
            foreach ($data['reserved'] as $key => $payload) {
                if ($payload[0] === $id) {
                    unset($data['reserved'][$key]);
                    break;
                }
            }
        });
        unlink("$this->path/job$id.data");
    }