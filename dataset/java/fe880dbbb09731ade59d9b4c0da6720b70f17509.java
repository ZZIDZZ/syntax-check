public void setBounds(double currentLower, double currentUpper, double newLower,
    		double newUpper) {
    	if (currentLower == currentUpper) {
    		throw new IllegalArgumentException("currentLower must not equal currentUpper. Both are " + currentUpper);
    	}
    	if (newLower == newUpper) {
    		throw new IllegalArgumentException("newLowerBound must not equal newUpperBound. Both are " + newUpper);
    	}
    	currentLowerBound = currentLower;
    	currentUpperBound = currentUpper;
    	newLowerBound = newLower;
    	newUpperBound = newUpper;
    	recalculateScaleBias();
    }