public function publishPages($urls)
    {
        LivePubHelper::init_pub();
        $r = $this->realPublishPages($urls);
        LivePubHelper::stop_pub();
        return $r;
    }