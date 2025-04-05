function tag(name) {
    if (!this.comment || !this.comment.tags) {
      return null;
    }
    
    for (var i = 0; i < this.comment.tags.length; i++) {
      var tagObj = this.comment.tags[i];
      if (tagObj.name === name) {
        return tagObj.value;
      }
    }
    return null;
  }