public function getContextualConcrete( $abstract )
    {
        if ( isset( $this->contextual[ Util::last( $this->buildStack ) ][ $abstract ] ) )
        {
            return $this->contextual[ Util::last( $this->buildStack ) ][ $abstract ];
        }

        return NULL;
    }