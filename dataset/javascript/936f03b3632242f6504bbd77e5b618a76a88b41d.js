function Store(name, items) {
    if (!name) {
      throw new Error('Please give the store a name!');
    }

    this.name = name;
    this.items = items || {};
    this.type = 'object';

    this.setType();
    return this;
  }