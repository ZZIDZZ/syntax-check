protected static int getShadowRadius(Drawable shadow, Drawable circle) {
        int radius = 0;

        if (shadow != null && circle != null) {
            Rect rect = new Rect();
            radius = (circle.getIntrinsicWidth() + (shadow.getPadding(rect) ? rect.left + rect.right : 0)) / 2;
        }

        return Math.max(1, radius);
    }