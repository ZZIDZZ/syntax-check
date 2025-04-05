protected function _request($type, $url, $params = array())
    {
        ApiDebug::p('running Client request', $this->_server);

        $method = 'POST';
        switch ($type) {
            case 'PUT':
                $params['http_method'] = 'put';
                break;
            case 'DELETE':
                $params['http_method'] = 'delete';
                break;
            case 'GET':
                $method = 'GET';
                break;
            default:
                break;
        }

        if (self::$_epoint == UPWORK_API_EP_NAME) {
            $url = $url . '.' . self::DATA_FORMAT;
        } elseif (self::$_epoint == UPWORK_GDS_EP_NAME) {
            $params['tqx'] = 'out:' . self::DATA_FORMAT;
        }

        $this->_server->option('sigMethod', ApiConfig::get('sigMethod'));
        $this->_server->option('epoint', self::$_epoint);

        $response = $this->_server->request($method, $url, $params);

        return json_decode($response);
    }