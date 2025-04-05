public function removeSubscribers($queue_name, $subscriber_hash)
    {
        $this->setJsonHeaders();
        $queue = rawurlencode($queue_name);
        $url = "projects/{$this->project_id}/queues/$queue/subscribers";
        $options = array(
            'subscribers' => $subscriber_hash,
        );
        return self::json_decode($this->apiCall(self::DELETE, $url, $options));
    }