public void back( int len ) {
        if ( pollIndex >= len )
            pollIndex -= len;
        else
            pollIndex = pollIndex + capacity() - len;

    }