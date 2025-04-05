public <T> T run(TransactionWrapper<T> operation) {
        QueryRunner runner = null;
        try {
            runner = queryRunnerFactory.create();
            T result = operation.perform(runner);
            runner.commit();

            return result;
        } catch (Throwable throwable) {
            TheCloser.rollback(runner);
            throw new TransactionInterruptedException(throwable);
        } finally {
            TheCloser.close(runner);
        }
    }