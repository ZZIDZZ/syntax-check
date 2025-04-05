private boolean readNextRow() {
		boolean hasNext = false;
		try {
			if(!stop) {
				String row = ""; 
				do {
					row = getReader().readLine(); 
				} while(row.length() == 0);
				
				if(!row.startsWith("{\"last_seq\":")) { 
					setNextRow(gson.fromJson(row, Row.class));
					hasNext = true;
				} 
			} 
		} catch (Exception e) {
			terminate();
			throw new CouchDbException("Error reading continuous stream.", e);
		} 
		if(!hasNext) 
			terminate();
		return hasNext;
	}