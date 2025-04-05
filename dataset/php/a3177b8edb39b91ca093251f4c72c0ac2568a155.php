private function requestXcdrSetAttribute($result, $schema)
    {
        $msgHeader = $result['msgHeader'];

        $soapObjectXML = '<format>DETAIL</format>
                        <msgHeader>
				<transactionID>' . $msgHeader->transactionID . '</transactionID>
                                <registrationID>' . $msgHeader->registrationID . '</registrationID>
			</msgHeader>'
        ;

        $soapXML = new \SoapVar($soapObjectXML, XSD_ANYXML, null, null, null, $schema);

        try {
            $result = $this->soapClient->RequestXcdrSetAttribute($soapXML);
        } catch (SoapTimeoutException $e) {
            return array(
                'status' => 'error',
                'type' => 'soap_fault',
                'message' => 'XCDR Soap Client Timeout. ' . $e->getMessage(),
                'class' => get_class($this)
            );
        } catch (\Exception $e) {
            return array(
                'status' => 'error',
                'type' => 'exception',
                'message' => 'XCDR Soap Client Exception. ' . $e->getMessage(),
                'class' => get_class($this)
            );
        }

        if (is_soap_fault($result)) {
            return array(
                'status' => 'error',
                'type' => 'soap_fault',
                'code' => $result->faultcode,
                'message' => $result->faultstring,
                'class' => get_class($this)
            );
        }

        return array(
            'status' => 'success',
            'result' => $result
        );
    }