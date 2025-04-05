protected function formatObject($oObj)
    {
        return (object) [
            'id'      => $oObj->id,
            'message' => auto_typography($oObj->message),
            'date'    => toUserDatetime($oObj->created),
            'user'    => (object) [
                'id'         => $oObj->created_by ? (int) $oObj->created_by->id : null,
                'first_name' => $oObj->created_by ? $oObj->created_by->first_name : null,
                'last_name'  => $oObj->created_by ? $oObj->created_by->last_name : null,
            ],
        ];
    }