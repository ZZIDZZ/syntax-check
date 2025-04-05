public function accountKitData($code)
    {
        $data = $this->data($code);

        $output = [
            'id' => $data->id,
            'phoneNumber' => '',
            'email' => '',
        ];

        if (array_key_exists('phone', $data)) {
            $output['phoneNumber'] = $data->phone->number ?? null;
        }

        if (array_key_exists('email', $data)) {
            $output['email'] = $data->email->address ?? null;
        }

        return $output;
    }