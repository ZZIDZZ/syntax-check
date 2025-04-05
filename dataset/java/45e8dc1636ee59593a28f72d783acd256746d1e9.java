protected int compareBookmarks(final Entry e1, final Entry e2) {
        if (e1 instanceof Bookmark && e2 instanceof Bookmark) {
            final Bookmark b1 = (Bookmark)e1;
            final Bookmark b2 = (Bookmark)e2;

            return new CompareToBuilder()
                .append(b1.getUrl(), b2.getUrl())
                .append(b1.isNewWindow(), b2.isNewWindow())
                .toComparison();
        }
        else {
            return 0;
        }
    }