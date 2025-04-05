protected function verifyOperation()
    {
        // This could happen if Ldap::unbind() has been called and then another ldap operation was
        // attempted with this link - in that case, the resource type will be 'Unknown'
        // This is an exceptional situation and so I shall throw one at you (see switch below)
        if (get_resource_type($this->resource) !== 'ldap link') {
            // I hope this code is not used by ldap...
            $this->code = -2;
            $this->message = 'Not a valid ldap link resource';
        } else {
            $this->code = ldap_errno($this->resource);
            $this->message = ldap_error($this->resource);
        }

        // Active Directory conceals some additional error codes in the ErrorMessage of the response
        // that we cannot get to with ldap_errno() in authentication failures - let's try to extract
        // them!
        if ($this->code === 49) {
            $errorString = $this->getOption(static::OPT_ERROR_STRING);

            // "LDAP: error code 49 - 80090308: LdapErr: DSID-0C090334, comment:
            // AcceptSecurityContext error, data 775, vece"
            //                                   ^^^
            // Note for my future self - the code '52e' will not be matched. But that's alright -
            // you would have replaced it with '49' anyway.
            preg_match('/(?<=data )[0-9]{2,3}/', $errorString, $matches);

            // Have we found it?
            if (count($matches) === 1) {
                $this->code = $matches[0];
            }
        }

        switch ($this->code) {
            // These response codes do not represent a failed operation; everything else does
            case static::SUCCESS:
            case static::SIZELIMIT_EXCEEDED:
            case static::COMPARE_FALSE:
            case static::COMPARE_TRUE:
                break;

            // An ldap operation was performed on a resource that has been already closed
            case -2:
                throw new \Exception($this->message, $this->code);

            default:
                throw new LdapException($this);
        }
    }