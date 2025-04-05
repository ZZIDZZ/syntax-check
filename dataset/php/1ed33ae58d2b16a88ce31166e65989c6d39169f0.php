public function isAuthentic()
    {
        // get the Github signature
        $xhub = $this->request->header('X-Hub-Signature') ?: 'nothing';

        // reconstruct the hash on this side
        $hash = 'sha1='.hash_hmac('sha1', $this->request->getContent(), config('auto-deploy.secret'));

        // securely compare them
        return hash_equals($xhub, $hash);
    }