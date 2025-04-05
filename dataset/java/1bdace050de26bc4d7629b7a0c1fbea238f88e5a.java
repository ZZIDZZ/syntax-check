public boolean anyMatched(String[] requestPathTokens) {
        return first.anyMatched(requestPathTokens) ||
                other.anyMatched(requestPathTokens) ||
                last.anyMatched(requestPathTokens);
    }