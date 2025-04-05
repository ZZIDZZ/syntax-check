private void overlapViews(int width) {
        if (width == mWidth) {
            return;
        }
        //remember this width so it is't processed twice
        mWidth = width;


        float percentage = calculatePercentage(width);
        float alpha = percentage / 100;

        mSmallView.setAlpha(1);
        mSmallView.setClickable(false);
        mLargeView.bringToFront();
        mLargeView.setAlpha(alpha);
        mLargeView.setClickable(true);
        mLargeView.setVisibility(alpha > 0.01f ? View.VISIBLE : View.GONE);

        //notify the crossfadeListener
        if (mCrossfadeListener != null) {
            mCrossfadeListener.onCrossfade(mContainer, calculatePercentage(width), width);
        }
    }