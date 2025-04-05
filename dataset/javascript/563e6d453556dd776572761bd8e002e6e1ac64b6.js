function Bundle(baseDirectory, options) {
    this.options = options || {};
    this.name = libpath.basename(baseDirectory);
    this.baseDirectory = baseDirectory;
    this.type = undefined;
    this.files = {};
    this.resources = {};
}