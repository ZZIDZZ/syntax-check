@Override
    public Iterator<UberNode> iterator() {

        return new Iterator<UberNode>() {

            int index = 0;

            @Override
            public void remove() {
                throw new UnsupportedOperationException("removing from uber node is not supported");
            }

            @Override
            public UberNode next() {
                index = findNextChildWithData();
                return data.get(index++);
            }

            @Override
            public boolean hasNext() {
                return findNextChildWithData() != -1;
            }

            private int findNextChildWithData() {
                for (int i = index; i < data.size(); i++) {
                    if (!data.get(i)
                            .getData()
                            .isEmpty()) {
                        return i;
                    }
                }
                return -1;
            }
        };
    }