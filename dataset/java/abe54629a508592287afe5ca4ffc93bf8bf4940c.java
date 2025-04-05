protected Throwable unwrapThrowable(Throwable t) {
        Throwable e = t;
        while (true) {
            if (e instanceof InvocationTargetException) {
                e = ((InvocationTargetException) t).getTargetException();
            } else if (t instanceof UndeclaredThrowableException) {
                e = ((UndeclaredThrowableException) t).getUndeclaredThrowable();
            } else {
                return e;
            }
        }
    }