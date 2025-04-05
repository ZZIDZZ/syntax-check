public function delete_object_type_by_uuid($UUID, $TYPE)
    {
        // Get our valid object types
        $TYPES = $this->object_types();
        // Check to see if the one we were passed is valid for this function
        if (!in_array($TYPE, $TYPES)) {
            throw new \Exception("Object type provided {$TYPE} is not supported");
        }

        $QUERY = ['uuid' => $UUID];
        $FUNCTION = 'remove'.$TYPE;
        $BASETIME = $this->microtimeTicks();
        $RETURN = $this->SOAPCLIENT->$FUNCTION($QUERY);
        $DIFFTIME = $this->microtimeTicks() - $BASETIME;
        $this->log_soap_call($FUNCTION, $DIFFTIME, $QUERY, $RETURN);

        return $RETURN;
    }