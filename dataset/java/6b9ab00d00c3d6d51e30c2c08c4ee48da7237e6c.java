public static Buckets fromStep(long start, long end, long step) {
        checkTimeRange(start, end);
        checkArgument(step > 0, "step is not positive: %s", step);
        if (step > (end - start)) {
            return new Buckets(start, step, 1);
        }
        long quotient = (end - start) / step;
        long remainder = (end - start) % step;
        long count;
        if (remainder == 0) {
            count = quotient;
        } else {
            count = quotient + 1;
        }
        checkArgument(count <= Integer.MAX_VALUE, "Computed number of buckets is too big: %s", count);
        return new Buckets(start, step, (int) count);
    }