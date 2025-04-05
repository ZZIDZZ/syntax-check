function(json){
    
    // Protect against forgetting the new keyword when calling the constructor
    if(!(this instanceof SearchInfo)){
      return new SearchInfo(json);
    }
    
    // If the given object is already an instance then just return it. DON'T copy it.
    if(SearchInfo.isInstance(json)){
      return json;
    }
    
    this.init(json);
  }