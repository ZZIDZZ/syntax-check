function ReadFileCache(sourceDir, charset) {
    assert.ok(this instanceof ReadFileCache);
    assert.strictEqual(typeof sourceDir, "string");

    this.charset = charset;

    EventEmitter.call(this);

    Object.defineProperties(this, {
        sourceDir: { value: sourceDir },
        sourceCache: { value: {} }
    });
}