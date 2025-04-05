function Index(name, target, kind, options) {
  /**
   * Name of the index.
   * @type {String}
   */
  this.name = name;
  /**
   * Target of the index.
   * @type {String}
   */
  this.target = target;
  /**
   * A numeric value representing index kind (0: custom, 1: keys, 2: composite);
   * @type {Number}
   */
  this.kind = typeof kind === 'string' ? getKindByName(kind) : kind;
  /**
   * An associative array containing the index options
   * @type {Object}
   */
  this.options = options;
}