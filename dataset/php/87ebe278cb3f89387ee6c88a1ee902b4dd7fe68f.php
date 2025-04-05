private function validateTransactions($trans)
    {
        $result = AResponse::ERR_NO_ERROR;
            foreach ($trans as $one) {
                if (is_array($one)) {
                    $accDbt = $one[ETrans::A_DEBIT_ACC_ID];
                    $accCrd = $one[ETrans::A_CREDIT_ACC_ID];
                } else {
                    $accDbt = $one->getDebitAccId();
                    $accCrd = $one->getCreditAccId();
                }
                if ($accDbt == $accCrd) {
                    $result = AResponse::ERR_ONE_ACCOUNT_FOR_DEBIT_AND_CREDIT;
                    break;
                }
            }
        return $result;
    }