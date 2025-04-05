private int getInBoundsX(int x) {

        if(x < 0) {
            x = 0;
        } else if(x > ((itemWidth + (int) dividerSize) * (values.length - 1))) {
            x = ((itemWidth + (int) dividerSize) * (values.length - 1));
        }
        return x;
    }