private function desensitization(string $host) : string
    {
        if ($px1 = strpos($host, '@')) {
            $px2 = strpos($host, ':', ($pxs = strpos($host, '://')) ? $pxs + 3 : 0);
            return substr($host, 0, $px2 + 1) . '***' . substr($host, $px1);
        }
        return $host;
    }