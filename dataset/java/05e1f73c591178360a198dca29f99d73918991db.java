public BaseVertex getOpposite(BaseVertex vertex) {
        // If null or not part of this connection
        if ( vertex == null || (!vertex.equals( getSource() ) && !vertex.equals( getTarget() )) ) {
            return null;
        }
        if ( vertex.equals( getSource() ) ) {
            return getTarget();
        }
        return getSource();
    }