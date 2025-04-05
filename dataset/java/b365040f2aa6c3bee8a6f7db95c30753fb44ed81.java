public Stream<T2<L, R>> strictOneToOne(Collection<? extends R> rights) {
        return strictOneToOne(rights.stream());
    }