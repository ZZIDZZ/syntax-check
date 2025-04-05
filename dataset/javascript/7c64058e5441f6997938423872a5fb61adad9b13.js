function handleDragEvents(e) {
    e.stopPropagation();
    e.preventDefault();
    return this.emit(e.type, e);
  }