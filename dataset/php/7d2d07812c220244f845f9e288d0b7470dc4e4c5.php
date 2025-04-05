private function getResponseJSON( $body ) {
        try {
            return json_decode( (string) $body, true );
        }
        catch ( \Exception $e ) {
            throw new \RuntimeException( 'Invalid JSON ' . $e->getMessage(), 0, $body );
        }
    }