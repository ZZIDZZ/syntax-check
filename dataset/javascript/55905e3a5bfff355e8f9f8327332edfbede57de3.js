function Mock(mount, options) {
    // convert to absolute path
    this.mount = mount;
    this.options = options || {};
    this.options.params = this.options.params === undefined ? true : this.options.params;
    this.locator = new Locator(mount);

    debug('mount at %s', this.mount);
}