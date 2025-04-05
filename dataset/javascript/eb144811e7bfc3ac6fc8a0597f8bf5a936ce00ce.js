function Event(name, attributes) {
    this._name = name;
    this._stopped = false;
    this._attrs = {};

    if (attributes) {
        this.setAttributes(attributes);
    }
}