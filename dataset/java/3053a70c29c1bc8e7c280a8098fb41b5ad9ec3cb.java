public int getSumDegree() {
		if(sumDegree < 0) {
			int sum = 0;
			for(Word word : words) {
				if(word != null && word.getDegree() > -1) {
					sum += word.getDegree();
				}
			}
			sumDegree = sum;
		}
		return sumDegree;
	}