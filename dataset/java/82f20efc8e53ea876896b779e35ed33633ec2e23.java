private Set<R> multiplication() {
        final Set<R> answer = new LinkedHashSet<>(
            this.one.size() * this.two.size()
        );
        for (final A left : this.one) {
            for (final B right : this.two) {
                final R element = this.function.apply(left, right);
                if (answer.contains(element)) {
                    throw new IllegalStateException(
                        String.format(
                            "Cartesian product result contains duplicated element %s",
                            element
                        )
                    );
                }
                answer.add(element);
            }
        }
        return ImmutableSet.copyOf(answer);
    }