function Company(parent, definition) {
  var key;
  for (key in updateMixin) {
    this[key] = updateMixin[key];
  }
  Company.super_.apply(this, arguments);
}