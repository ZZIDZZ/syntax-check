public function buildResponse($functionName, $invoiceId, $result_code, $message = null)
    {
        try {
            $performedDatetime = self::formatDate(new \DateTime());
            $response = '<?xml version="1.0" encoding="UTF-8"?><'.$functionName.'Response performedDatetime="'.$performedDatetime.
                '" code="'.$result_code.'" '.($message != null ? 'message="'.$message.'"' : "").' invoiceId="'.$invoiceId.'" shopId="'.$this->shop_id.'"/>';
            return $response;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage(), static::class);
        }
        return null;
    }