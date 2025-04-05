@Override
    public void close() {
        if (closed.getAndSet(true)) {
            return;
        }

        for (Map.Entry<StatementMethod, StatementHolder> entry : statementCache.entrySet()) {
            StatementHolder value = entry.getValue();
            statementCache.remove(entry.getKey(), value);
            quietClose(value.rawStatement());
        }
    }