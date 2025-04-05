protected function getTokenFromRequest(Request $request)
    {
        $token = $request->getParameter($this->key) ?: $request->getHeader('X-CSRF-TOKEN');
        
        return $token;
    }