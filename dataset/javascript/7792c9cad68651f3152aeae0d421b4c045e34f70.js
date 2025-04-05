function (rules) {
  this._instantiatedDate = new Date();
  this._instanceCount = 0;
  this._propertyCount = 0;

  this._collatedInstances = null;

  this._rules = (rules && this._checkRules(rules)) || [];

  this.initEventualSchema();
}