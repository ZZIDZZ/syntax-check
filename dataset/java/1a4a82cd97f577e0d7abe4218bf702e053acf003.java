public Selector overlapVerticallyWith(final SlideElement element, final float minOverlapRatio){	
		checkNotNull(element);
		final Rectangle r1 = element.getBounds();
		r1.x = 0; r1.width = 1;		
		elements = Collections2.filter(elements, new Predicate<SlideElement>(){
			@Override
			public boolean apply(SlideElement e) {
				if (e == element){
					return false;
				}				
				if (r1.height == 0){
					return false;
				}
				Rectangle r2 =e.getBounds();
				r2.x = 0; r2.width = 1;
				Rectangle intersection = r1.intersection(r2);
				float yOverlapRatio = 1f * intersection.height / r1.height;			
				return yOverlapRatio > minOverlapRatio;
			}		
		});		
		return this;
	}