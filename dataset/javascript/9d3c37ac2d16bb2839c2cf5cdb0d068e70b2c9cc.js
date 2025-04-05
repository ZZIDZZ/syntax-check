function() {
    Object.defineProperty(this, "_impl", {
        value : new EJDBImpl(),
        configurable : false,
        enumerable : false,
        writable : false
    });
    return this;
}